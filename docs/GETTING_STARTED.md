# 🎯 Getting Started - PlayBeat Digital

Complete step-by-step guide to setup and run PlayBeat Digital.

## Prerequisites

- **Node.js** 14+ ([Download](https://nodejs.org/))
- **npm** (comes with Node.js)
- **Git** ([Download](https://git-scm.com/))

## Step 1: Clone Repository

```bash
git clone https://github.com/rahulk6778/ins.git
cd ins
```

## Step 2: Run Setup Script

### Windows
```powershell
.\scripts\setup.bat
```

### Mac/Linux
```bash
bash scripts/setup.sh
```

This will automatically:
- Create necessary directories
- Install Node dependencies
- Configure environment variables

### Manual Setup (if scripts don't work)

```bash
cd backend
npm install
```

## Step 3: Start Backend Server

```bash
cd backend
npm start
```

You should see:
```
Server running on http://localhost:3001
Serving frontend from: /path/to/frontend
Database loaded: 40 products
```

## Step 4: Access Application

### Option A: Browser
Open http://localhost:3001

### Option B: Direct File
Open `frontend/index-dynamic.html` in your browser

### Option C: Development Server
```bash
# In another terminal
cd frontend
python -m http.server 8000
# Visit http://localhost:8000
```

## Step 5: Test Features

1. **Browse Categories**
   - Click any category (Games, Software, etc.)
   - Products load dynamically

2. **Add to Cart**
   - Click "Add to Cart" on any product
   - Cart counter updates
   - Total price calculates

3. **Wishlist**
   - Click heart icon to add/remove from wishlist
   - State persists in browser

4. **Checkout**
   - Click cart icon
   - Review items
   - Click checkout
   - Fill customer info

## Project Structure

```
ins/
├── backend/           # Node.js + Express server
├── frontend/          # HTML/CSS/JS frontend
├── docs/              # Documentation
├── scripts/           # Setup scripts
└── README.md          # Project overview
```

## Environment Configuration

Create `backend/.env`:
```env
PORT=3001
NODE_ENV=development
CORS_ORIGIN=*
```

## Testing

### Automated Tests
```bash
cd backend
npm test
```

### Manual API Testing

**Get all categories:**
```bash
curl http://localhost:3001/api/categories
```

**Get game products:**
```bash
curl http://localhost:3001/api/categories/games
```

**Calculate cart:**
```bash
curl -X POST http://localhost:3001/api/cart/calculate \
  -H "Content-Type: application/json" \
  -d '{
    "items": [{"id": "elden-ring", "quantity": 1, "price": 59.99}]
  }'
```

## Troubleshooting

### Problem: Port 3001 already in use

**Solution:**
```bash
# Find process
lsof -i :3001

# Kill process
kill -9 <PID>

# Or use different port in .env
PORT=3002
```

### Problem: npm install fails

**Solution:**
```bash
# Clear npm cache
npm cache clean --force

# Remove node_modules
rm -rf node_modules

# Reinstall
npm install
```

### Problem: Frontend not loading

**Solution:**
1. Check backend is running: `npm start`
2. Try http://localhost:3001 in browser
3. Check console for errors (F12)
4. Verify port in .env file

### Problem: CORS errors

**Solution:**
Ensure `.env` has:
```env
CORS_ORIGIN=*
```

### Problem: Products not showing

**Solution:**
1. Check `backend/products.json` exists
2. Verify backend is running
3. Check API: http://localhost:3001/api/products
4. View browser console for errors

## Next Steps

1. **Explore Features**
   - Try all product categories
   - Test cart calculations
   - Test checkout flow

2. **Understand Code**
   - Read `backend/server.js` (Express setup)
   - Read `frontend/index-dynamic.html` (Frontend)
   - Check `backend/products.json` (Data)

3. **Customize**
   - Edit products in `backend/products.json`
   - Change theme in `frontend/assets/css/shared.css`
   - Modify prices and descriptions

4. **Deploy**
   - Follow [Deployment Guide](DEPLOYMENT.md)
   - Choose hosting platform
   - Setup custom domain

## Customization

### Change Port
Edit `backend/.env`:
```env
PORT=3002
```

### Add Products
Edit `backend/products.json`:
```json
{
  "categories": [
    {
      "id": "games",
      "products": [
        {
          "id": "my-game",
          "name": "My Game",
          "price": 49.99,
          "description": "Description",
          "image": "https://...",
          "rating": 4.5
        }
      ]
    }
  ]
}
```

### Change Styling
Edit `frontend/assets/css/shared.css` - CSS variables at top:
```css
:root {
  --primary: #your-color;
  --secondary: #your-color;
}
```

## Additional Resources

- [API Documentation](API.md) - Full API reference
- [Commands Reference](COMMANDS.md) - All CLI commands
- [Deployment Guide](DEPLOYMENT.md) - Deploy to production
- [Architecture Guide](ARCHITECTURE.md) - System design

## Support

If you encounter issues:

1. Check error messages in console
2. Review troubleshooting section above
3. Check documentation files
4. Review backend logs: `pm2 logs`

## Running in Background (Production)

### Using PM2

```bash
cd backend
pm2 start server.js --name "playbeat"
pm2 startup
pm2 save
```

### Using Screen

```bash
cd backend
screen -S playbeat
npm start

# Detach: Ctrl+A then D
# Reattach: screen -r playbeat
```

### Using nohup

```bash
cd backend
nohup npm start > server.log &
tail -f server.log
```

---

## Checklist

- [ ] Node.js installed
- [ ] Repository cloned
- [ ] Dependencies installed
- [ ] Backend started
- [ ] Frontend accessible
- [ ] Products loaded
- [ ] Cart working
- [ ] Checkout functional

---

**Version:** 1.0
**Last Updated:** 2026-06-01
**Status:** Ready for Production
