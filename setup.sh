#!/bin/bash

# Library Management System - Setup Script
# This script automates the initial setup process

echo "🚀 Setting up Library Management System..."
echo ""

# Check if .env exists
if [ ! -f .env ]; then
    echo "📝 Creating .env file from .env.example..."
    cp .env.example .env
    echo "✅ .env file created"
else
    echo "ℹ️  .env file already exists, skipping..."
fi

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker is not running. Please start Docker and try again."
    exit 1
fi

echo ""
echo "🐳 Building and starting Docker containers..."
docker-compose up -d --build

echo ""
echo "⏳ Waiting for services to be ready..."
sleep 10

echo ""
echo "📦 Installing PHP dependencies..."
docker-compose exec -T web composer install

echo ""
echo "🗄️  Running database migrations..."
docker-compose exec -T web php spark migrate

echo ""
echo "🖼️  Creating placeholder image..."
docker-compose exec -T web php create_placeholder.php

echo ""
echo "🔒 Setting permissions..."
docker-compose exec -T web chmod -R 777 public/uploads

echo ""
echo "✅ Setup complete!"
echo ""
echo "🌐 Access the application at: http://localhost:8080"
echo ""
echo "📚 Useful commands:"
echo "   - View logs: docker-compose logs -f"
echo "   - Stop containers: docker-compose down"
echo "   - Restart containers: docker-compose restart"

