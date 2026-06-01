# 🏗️ PlayBeat Digital - System Architecture

## Overview

PlayBeat Digital uses a classic **Client-Server Architecture** with separation of concerns:

```
┌─────────────────────────────────────────────────┐
│           Browser / Client Layer                │
│  (HTML5 + CSS3 + JavaScript ES6)               │
│  - Dynamic product loading                      │
│  - Cart management                              │
│  - Wishlist functionality                       │
└──────────────────┬──────────────────────────────┘
                   │ HTTP/CORS
┌──────────────────▼──────────────────────────────┐
│        Express.js / Backend Server              │
│  - RESTful API endpoints                        │
│  - Static file serving                          │
│  - CORS middleware                              │
│  - JSON database                                │
└─────────────────────────────────────────────────┘
```

## Architecture Layers

### 1. Presentation Layer (Frontend)

**Location:** `frontend/`

**Components:**
- `index-dynamic.html` - Main application entry point
- `categories/*.html` - Category pages
- `assets/css/shared.css` - Global styles
- `assets/js/shared.js` - Global scripts

**Responsibilities:**
- User interface rendering
- Event handling
- API communication
- Local state management (cart, wishlist)

### 2. API Layer (Backend)

**Location:** `backend/`

**Main server:** `server.js` (50+ lines of Express.js)

**Endpoints:**
```
GET  /api/categories
GET  /api/categories/:id
GET  /api/products
GET  /api/products/:id
POST /api/cart/calculate
POST /api/cart/checkout
```

### 3. Data Layer

**Location:** `backend/products.json`

**Format:** 10 categories with 4 products each (40 total)

## Technology Stack

- **Backend:** Node.js + Express.js
- **Frontend:** HTML5 + CSS3 + Vanilla JavaScript
- **Database:** JSON (can upgrade to PostgreSQL)
- **No external dependencies:** Lightweight & fast

## Deployment Architecture

### Development
```
localhost:3001 → Node.js + Express
```

### Production Options
- Heroku
- AWS (EC2, Lambda, Amplify)
- DigitalOcean
- Custom VPS

See `docs/DEPLOYMENT.md` for details.

---

**Version:** 1.0 | **Status:** Production Ready
