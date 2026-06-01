const express = require('express');
const cors = require('cors');
const path = require('path');
const fs = require('fs');
require('dotenv').config();

const app = express();
const PORT = process.env.PORT || 3001;

// Middleware
app.use(cors());
app.use(express.json());
app.use(express.static(path.join(__dirname, '../frontend')));

// Load products database
let products = [];
try {
  const data = fs.readFileSync(path.join(__dirname, 'products.json'), 'utf8');
  products = JSON.parse(data);
  console.log(`✓ Database loaded: ${products.categories.reduce((sum, cat) => sum + cat.products.length, 0)} products`);
} catch (err) {
  console.error('Error loading products:', err.message);
}

// API Routes

// Get all categories
app.get('/api/categories', (req, res) => {
  try {
    const categories = products.categories.map(cat => ({
      id: cat.id,
      name: cat.name,
      emoji: cat.emoji,
      productCount: cat.products.length
    }));
    res.json({
      success: true,
      data: categories,
      count: categories.length,
      timestamp: new Date().toISOString()
    });
  } catch (err) {
    res.status(500).json({ error: true, message: err.message });
  }
});

// Get products by category
app.get('/api/categories/:id', (req, res) => {
  try {
    const category = products.categories.find(cat => cat.id === req.params.id);
    if (!category) {
      return res.status(404).json({ error: true, message: 'Category not found' });
    }
    res.json({
      success: true,
      category: { id: category.id, name: category.name, emoji: category.emoji },
      data: category.products,
      count: category.products.length,
      timestamp: new Date().toISOString()
    });
  } catch (err) {
    res.status(500).json({ error: true, message: err.message });
  }
});

// Get all products
app.get('/api/products', (req, res) => {
  try {
    const allProducts = products.categories.flatMap(cat => cat.products);
    res.json({
      success: true,
      data: allProducts,
      count: allProducts.length,
      timestamp: new Date().toISOString()
    });
  } catch (err) {
    res.status(500).json({ error: true, message: err.message });
  }
});

// Get single product
app.get('/api/products/:id', (req, res) => {
  try {
    for (let category of products.categories) {
      const product = category.products.find(p => p.id === req.params.id);
      if (product) {
        return res.json({
          success: true,
          data: product,
          timestamp: new Date().toISOString()
        });
      }
    }
    res.status(404).json({ error: true, message: 'Product not found' });
  } catch (err) {
    res.status(500).json({ error: true, message: err.message });
  }
});

// Calculate cart total
app.post('/api/cart/calculate', (req, res) => {
  try {
    const { items, taxRate = 0.08 } = req.body;
    if (!items || !Array.isArray(items)) {
      return res.status(400).json({ error: true, message: 'Invalid items' });
    }

    let subtotal = 0;
    items.forEach(item => {
      subtotal += (item.price || 0) * (item.quantity || 1);
    });

    const tax = subtotal * taxRate;
    const total = subtotal + tax;

    res.json({
      success: true,
      data: {
        items: items,
        subtotal: parseFloat(subtotal.toFixed(2)),
        tax: parseFloat(tax.toFixed(2)),
        discount: 0,
        total: parseFloat(total.toFixed(2)),
        itemCount: items.length,
        timestamp: new Date().toISOString()
      }
    });
  } catch (err) {
    res.status(500).json({ error: true, message: err.message });
  }
});

// Process checkout
app.post('/api/cart/checkout', (req, res) => {
  try {
    const { items, customer } = req.body;
    if (!items || !customer) {
      return res.status(400).json({ error: true, message: 'Invalid checkout data' });
    }

    let subtotal = 0;
    items.forEach(item => {
      subtotal += (item.price || 0) * (item.quantity || 1);
    });

    const tax = subtotal * 0.08;
    const total = subtotal + tax;
    const orderId = `ORD-${Date.now()}`;

    res.json({
      success: true,
      data: {
        orderId: orderId,
        status: 'completed',
        total: parseFloat(total.toFixed(2)),
        items: items.length,
        customer: customer.email,
        timestamp: new Date().toISOString(),
        estimatedDelivery: new Date(Date.now() + 4 * 24 * 60 * 60 * 1000).toISOString()
      }
    });
  } catch (err) {
    res.status(500).json({ error: true, message: err.message });
  }
});

// Health check
app.get('/api/health', (req, res) => {
  res.json({ status: 'ok', timestamp: new Date().toISOString() });
});

// Serve frontend
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, '../frontend/index-dynamic.html'));
});

// 404 handler
app.use((req, res) => {
  res.status(404).json({ error: true, message: 'Not found' });
});

// Error handler
app.use((err, req, res, next) => {
  console.error(err);
  res.status(500).json({ error: true, message: 'Internal server error' });
});

// Start server
app.listen(PORT, () => {
  console.log('\n🚀 PlayBeat Digital Server Started');
  console.log(`📍 URL: http://localhost:${PORT}`);
  console.log(`📁 Frontend: http://localhost:${PORT}`);
  console.log(`🔌 API: http://localhost:${PORT}/api`);
  console.log(`✓ CORS enabled`);
  console.log('\n💡 Press Ctrl+C to stop server\n');
});

module.exports = app;