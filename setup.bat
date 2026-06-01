@echo off
color 0A
title PlayBeat Digital - Professional Setup
cls
echo.
echo ============================================
echo    PlayBeat Digital - Complete Setup
echo ============================================
echo.
echo Installing backend dependencies...
cd backend
call npm install
cd ..
echo.
echo ============================================
echo    Setup Complete!
echo ============================================
echo.
echo To start the backend server:
echo.
echo   1. Open PowerShell or Command Prompt
echo   2. Navigate to backend folder: cd backend
echo   3. Run: npm start
echo.
echo Backend will run on: http://localhost:3001
echo.
echo Frontend options:
echo   - Open: new/index-dynamic.html (with dynamic loading)
echo   - Open: new/index.html (alternative version)
echo.
echo Project Structure:
echo   - backend/      (Node.js server & API)
echo   - new/          (Frontend HTML files)
echo   - README.md     (Full documentation)
echo.
echo Features:
echo   ✓ Dynamic product loading from backend
echo   ✓ 10 product categories
echo   ✓ Shopping cart functionality
echo   ✓ Professional premium UI
echo   ✓ Responsive design
echo.
echo Happy coding! 🚀
echo.
pause
