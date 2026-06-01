# 🚀 PlayBeat Digital - Getting Started

## Complete Installation & Running Guide

### 📋 Prerequisites
- Node.js installed (download from https://nodejs.org/)
- A code editor (VS Code recommended)
- PowerShell or Command Prompt

### ⚡ Quick Start (5 minutes)

#### Windows Users:
1. Double-click `setup.bat` in the project folder
2. Wait for installation to complete
3. Run in PowerShell:
   ```powershell
   cd backend
   npm start
   ```
4. Open browser: `http://localhost:3001`

#### Mac/Linux Users:
```bash
bash setup.sh
cd backend
npm start
```

### 📁 Project Structure

```
UPDATED/
├── backend/
│   ├── server.js          (Express server)
│   ├── products.json      (Product database)
│   ├── package.json       (Dependencies)
│   └── node_modules/      (Installed packages)
├── new/
│   ├── index-dynamic.html (Main homepage - Dynamic loading)
│   ├── index.html         (Alternative version)
│   ├── games.html         (Games category)
│   ├── gift-cards.html    (Gift cards category)
│   ├── software.html      (Software category)
│   ├── ai-tools.html      (AI Tools category)
│   ├── game-items.html    (Game items category)
│   ├── accounts.html      (Accounts category)
│   ├── subscriptions.html (Subscriptions category)
│   ├── top-up.html        (Top up category)
│   ├── trending.html      (Trending section)
│   ├── best-value.html    (Best value deals)
│   ├── shared.css         (Global styles)
│   └── shared.js          (Global scripts)
├── README.md              (Full documentation)
├── GETTING_STARTED.md     (This file)
├── setup.bat              (Windows setup)
├── setup.sh               (Mac/Linux setup)
└── .env                   (Environment variables)
```

### 🔧 Manual Installation

If automatic setup doesn't work:

1. **Open PowerShell** and navigate to project:
   ```powershell
   cd "C:\path\to\UPDATED"
   ```

2. **Install dependencies**:
   ```powershell
   cd backend
   npm install
   ```

3. **Start the server**:
   ```powershell
   npm start
   ```

4. **Open in browser**:
   - Navigate to: `http://localhost:3001`
   - Or open: `new/index-dynamic.html` directly

### 🎯 What Each File Does

**Backend (Node.js + Express):**
- `server.js` - Main server with API endpoints
- `products.json` - Database with all products

**Frontend:**
- `index-dynamic.html` - RECOMMENDED! Has live product loading
- `index.html` - Traditional structure
- `*-category*.html` - Individual category pages

### 📡 API Endpoints

Once backend is running, test these in browser:

```
http://localhost:3001/api/products
http://localhost:3001/api/products/games
http://localhost:3001/api/products/gift-cards
http://localhost:3001/api/products/software
http://localhost:3001/api/products/ai-tools
http://localhost:3001/api/products/game-items
http://localhost:3001/api/products/accounts
http://localhost:3001/api/products/subscriptions
http://localhost:3001/api/products/top-up
http://localhost:3001/api/products/trending
http://localhost:3001/api/products/best-value
```

### 🛒 Key Features

✅ **Dynamic Product Loading** - Products load from backend
✅ **Shopping Cart** - Add/remove items, view total
✅ **Wishlist** - Click heart icons to save favorites
✅ **Responsive Design** - Works on desktop, tablet, mobile
✅ **10 Categories** - Games, Software, AI Tools, and more
✅ **Professional UI** - Premium dark theme with animations
✅ **Real-time Updates** - No page refresh needed
✅ **Mobile Top-up** - Data bundles and roaming
✅ **Trending Section** - Hot deals this week
✅ **Best Value** - Discounted bundles

### 🎨 Product Categories

1. **Games** - Elden Ring, Cyberpunk 2077, Starfield, Baldur's Gate 3
2. **Gift Cards** - Steam, PlayStation, Xbox, Nintendo
3. **Software** - Windows 11, Office 365, Antivirus, VPN
4. **AI Tools** - ChatGPT Plus, Midjourney, Copilot, Firefly
5. **Game Items** - Battle Pass, Cosmetics, Gold, Weapons
6. **Accounts** - Xbox Game Pass, PlayStation Plus, Discord
7. **Subscriptions** - Netflix, Spotify, YouTube Premium, Adobe CC
8. **Top Up** - Mobile data, International roaming
9. **Trending** - Most popular items this week
10. **Best Value** - Limited time super deals

### 💾 Adding More Products

Edit `backend/products.json`:

```json
{
  "id": "UNIQUE_ID",
  "name": "Product Name",
  "price": 99.99,
  "image": "https://image-url.com/image.jpg",
  "description": "Product description",
  "category": "games"
}
```

### ⚙️ Configuration

**Change API URL:**
In any HTML file, find:
```javascript
const API_BASE='http://localhost:3001';
```
Change to your server address if needed.

**Change Port:**
In `backend/server.js`, find:
```javascript
const PORT = 3001;
```
Change to different port number.

### 🐛 Troubleshooting

**Backend won't start:**
- Check if port 3001 is already in use
- Try different port: Edit server.js
- Ensure Node.js is installed: `node --version`

**Products not loading:**
- Backend must be running on localhost:3001
- Check browser console (F12) for errors
- Verify products.json exists in backend folder

**CORS errors:**
- Already enabled in backend
- Check API_BASE URL in HTML files

**Styling looks broken:**
- Clear browser cache (Ctrl+Shift+Delete)
- Hard refresh (Ctrl+F5)
- Check CSS file is loading

### 📚 Useful Commands

```powershell
# Check Node version
node --version

# Check npm version
npm --version

# Install dependencies
npm install

# Start backend
npm start

# Stop server (Ctrl+C in terminal)

# Clear npm cache
npm cache clean --force

# Reinstall node_modules
rm -r node_modules
npm install
```

### 🔐 Security Features

- CORS configured for safe API access
- No sensitive data in frontend
- Client-side cart management
- Secure file paths on backend
- Input validation

### 🚀 Performance

- Products loaded in memory (fast)
- No database overhead
- Static file serving optimized
- CSS animations use GPU
- Minimal JavaScript

### 📞 Support

For issues:
1. Check browser console (F12 → Console tab)
2. Check server terminal for errors
3. Verify all files exist
4. Try restarting backend
5. Clear browser cache

### 🎓 Learning Resources

- Understand the file structure
- Examine backend/server.js for API
- Check new/index-dynamic.html for frontend
- Review products.json for data structure
- Inspect CSS for styling patterns

### ✨ Next Steps

1. ✅ Complete setup and run locally
2. ✅ Test all product categories
3. ✅ Add more products to products.json
4. ✅ Customize colors in CSS
5. ✅ Add authentication system
6. ✅ Connect to real database
7. ✅ Deploy to production

### 📝 Notes

- All code is minified for production
- No external dependencies in frontend
- Backend uses Express.js (lightweight)
- Fully responsive design
- Works offline with local files

### 🎉 You're All Set!

Your PlayBeat Digital marketplace is ready to use. Start the backend and explore all features!

---

**Questions?** Check README.md for more details
**Version:** 1.0.0
**Last Updated:** 2026
