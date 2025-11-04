# Library Management System - Setup Script (PowerShell)
# This script automates the initial setup process for Windows

Write-Host "🚀 Setting up Library Management System..." -ForegroundColor Cyan
Write-Host ""

# Check if .env exists
if (-not (Test-Path .env)) {
    Write-Host "📝 Creating .env file from .env.example..." -ForegroundColor Yellow
    Copy-Item .env.example .env
    Write-Host "✅ .env file created" -ForegroundColor Green
} else {
    Write-Host "ℹ️  .env file already exists, skipping..." -ForegroundColor Gray
}

# Check if Docker is running
try {
    docker info | Out-Null
} catch {
    Write-Host "❌ Docker is not running. Please start Docker Desktop and try again." -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "🐳 Building and starting Docker containers..." -ForegroundColor Cyan
docker-compose up -d --build

Write-Host ""
Write-Host "⏳ Waiting for services to be ready..." -ForegroundColor Yellow
Start-Sleep -Seconds 10

Write-Host ""
Write-Host "📦 Installing PHP dependencies..." -ForegroundColor Cyan
docker-compose exec -T web composer install

Write-Host ""
Write-Host "🗄️  Running database migrations..." -ForegroundColor Cyan
docker-compose exec -T web php spark migrate

Write-Host ""
Write-Host "🖼️  Creating placeholder image..." -ForegroundColor Cyan
docker-compose exec -T web php create_placeholder.php

Write-Host ""
Write-Host "🔒 Setting permissions..." -ForegroundColor Cyan
docker-compose exec -T web chmod -R 777 public/uploads

Write-Host ""
Write-Host "✅ Setup complete!" -ForegroundColor Green
Write-Host ""
Write-Host "🌐 Access the application at: http://localhost:8080" -ForegroundColor Cyan
Write-Host ""
Write-Host "📚 Useful commands:" -ForegroundColor Yellow
Write-Host "   - View logs: docker-compose logs -f"
Write-Host "   - Stop containers: docker-compose down"
Write-Host "   - Restart containers: docker-compose restart"

