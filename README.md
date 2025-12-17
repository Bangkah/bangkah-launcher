# 🎯 Bangkah - Laravel Starter Kit

<div align="center">

![Laravel 12.x](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)
![PHP 8.4+](https://img.shields.io/badge/PHP-8.4%2B-777BB4?style=for-the-badge&logo=php)
![License MIT](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)
![Composer](https://img.shields.io/badge/Composer-2.0%2B-885630?style=for-the-badge&logo=composer)
![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?style=for-the-badge&logo=docker)
[![codecov](https://codecov.io/gh/<USERNAME>/<REPO>/branch/main/graph/badge.svg?token=)](https://codecov.io/gh/<USERNAME>/<REPO>)

**Scaffold production-ready Laravel projects in seconds with Docker, Nginx, Authentication, and more!**

[Features](#-features) • [Installation](#-installation) • [Usage](#-usage) • [Examples](#-examples) • [Documentation](#-documentation) • [FAQ](#-faq)

</div>

---

## 📑 Table of Contents

- [About](#about)
- [Features](#-features)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Quick Start](#-quick-start)
- [Usage](#-usage)
  - [Interactive Mode](#interactive-mode)
  - [Non-Interactive Mode](#non-interactive-mode)
  - [Command Options](#command-options)
- [Examples](#-examples)
- [Templates](#-templates)
- [Docker Configuration](#-docker-configuration)
- [Database Setup](#-database-setup)
- [Authentication](#-authentication)
- [Frontend Assets](#-frontend-assets)
- [Deployment](#-deployment)
- [Troubleshooting](#-troubleshooting)
- [FAQ](#-faq)
- [Development](#-development)
- [Advanced Usage](#-advanced-usage)
- [Contributing](#-contributing)
- [Changelog](#changelog)
- [License](#-license)

---

## About

**Bangkah** adalah modern Laravel starter kit package yang dirancang untuk mempercepat development dengan menyediakan scaffolding otomatis untuk berbagai kebutuhan project. Dengan satu command, Anda bisa mendapatkan project Laravel yang sudah dikonfigurasi dengan Docker, Nginx, authentication, database, dan frontend framework pilihan Anda.

### Why Bangkah?

- ⏱️ **Save Time**: Setup yang biasanya butuh 30-60 menit sekarang hanya 2-3 menit
- 🎯 **Best Practices**: Mengikuti Laravel conventions dan industry standards
- 🔧 **Flexible**: Customize sesuai kebutuhan dengan interactive CLI
- 📦 **Production Ready**: Docker configs yang optimized untuk production
- 🚀 **Modern Stack**: Support Laravel 12.x dengan latest features
- 🎨 **Frontend Agnostic**: Pilih Tailwind, Bootstrap, atau headless API
- 🔐 **Security First**: Auth scaffolding dengan Laravel official packages

### What Makes Bangkah Different?

Unlike other starter kits, Bangkah focuses on **simplicity** and **flexibility**:
- No opinionated architecture - just clean Laravel best practices
- Interactive CLI that adapts to your needs
- Docker configs optimized for both development and production
- Automatic asset building - no manual intervention needed
- Zero learning curve - standard Laravel structure

---

## ✨ Features

<table>
<tr>
<td width="50%">

### 🚀 Zero Configuration
Interactive CLI wizard yang memandu Anda step-by-step. Tidak perlu memorize flags atau options!

### 🐳 Docker Ready
Dockerfile + docker-compose.yml generated otomatis dengan:
- PHP 8.2-FPM optimized
- Nginx latest stable
- MySQL 8 atau PostgreSQL 16
- Persistent volumes
- Network configured

### 🌐 Nginx Support
Production-ready Nginx configuration dengan:
- FastCGI caching
- Gzip compression
- Static file optimization
- Laravel-optimized routing

### 📦 Multiple Templates
- **Web Template**: Homepage, routes, HomeController
- **API Template**: Health endpoint, CORS configured, API routes enabled

</td>
<td width="50%">

### 🎨 Frontend Flexibility
Pilih framework sesuai preference:
- **Tailwind CSS** (recommended) - Modern utility-first
- **Bootstrap 5** - Classic responsive framework
- **None** - Perfect untuk headless API

### 🔐 Auth Scaffolding
- **Laravel Breeze** (Tailwind) - Minimal & elegant
- **Laravel UI** (Bootstrap) - Traditional & comprehensive
Lengkap dengan login, register, password reset, email verification!

### 💾 Database Options
Support multiple databases:
- **MySQL** 8.0 (most popular)
- **PostgreSQL** 16 (advanced features)
Auto-configured `.env` dengan credentials yang tepat.

### ⚡ Auto Build
Frontend assets di-build otomatis setelah:
- NPM package installation
- Auth scaffolding installation
No manual `npm run build` needed!

</td>
</tr>
</table>

---

## 📋 Requirements

| Requirement | Version | Notes |
|------------|---------|-------|
| PHP | 8.2 or higher | Required for Laravel 12.x |
| Composer | 2.0+ | Dependency management |
| Node.js | 18+ or 20+ LTS | For frontend assets |
| NPM | 9+ | Package manager |
| Docker | 20+ | Optional, for containerization |
| Docker Compose | 2.0+ | Optional, for multi-container setup |
| Git | 2.x+ | Recommended for version control |

### System Requirements

**Minimum:**
- 2 CPU cores
- 2GB RAM
- 5GB disk space

**Recommended:**
- 4+ CPU cores
- 4GB+ RAM
- 10GB+ disk space (with Docker)

---

## 📦 Installation

### Method 1: Fresh Laravel Project (Recommended)

Mulai dengan project Laravel baru:

```bash
# Step 1: Create Laravel project
composer create-project laravel/laravel my-awesome-project
cd my-awesome-project

# Step 2: Install Bangkah
composer require bangkah/bangkah

# Step 3: Run Bangkah scaffolding
php artisan bangkah:create
```

### Method 2: Existing Laravel Project

Jika Anda sudah punya project Laravel:

```bash
# Navigate to your project
cd my-existing-project

# Install Bangkah
composer require bangkah/bangkah

# Run scaffolding
php artisan bangkah:create
```

> ⚠️ **Warning**: Bangkah akan modify files seperti `.env`, routes, controllers. File routes akan dibackup otomatis sebagai `*.backup-YYYYMMDDHHMMSS` sebelum diganti.

### Verification

Verify instalasi berhasil:

```bash
php artisan list bangkah
```

Output:
```
Available commands for the "bangkah" namespace:
  bangkah:create  Create a new starter project with Bangkah
```

---

## 🚀 Quick Start

### 30-Second Setup

Ingin cepat? Jalankan dengan defaults:

```bash
php artisan bangkah:create \
  --type=web \
  --frontend=tailwind \
  --docker \
  --nginx \
  --db=mysql \
  --yes
```

Selesai! Project Anda sudah siap dengan Docker, Nginx, MySQL, dan Tailwind CSS.

Start containers:

```bash
docker compose up -d
```

Access aplikasi di `http://localhost`

---

## 📖 Usage

### Interactive Mode

Mode paling mudah - Bangkah akan menanyakan semua pilihan interactively:

```bash
php artisan bangkah:create
```

#### Interactive Flow

```
┌──────────────────────────────────────────┐
│  🎯 Bangkah Starter Kit                  │
└──────────────────────────────────────────┘

❯ Pilih template project:
  ○ Web Application (dengan homepage)
  ● API Application (RESTful API)

❯ Install Docker?
  ● Yes
  ○ No

❯ Install Nginx?
  ● Yes
  ○ No

❯ Pilih database:
  ● MySQL
  ○ PostgreSQL

❯ Pilih frontend framework:
  ● Tailwind CSS
  ○ Bootstrap
  ○ None

❯ Install authentication?
  ○ Laravel Breeze (Tailwind)
  ○ Laravel UI (Bootstrap)
  ● No
```

Setelah semua pilihan dibuat, Bangkah akan:
1. ✅ Generate files berdasarkan template
2. ✅ Configure environment variables
3. ✅ Install dependencies (composer & npm)
4. ✅ Build frontend assets
5. ✅ Start Docker containers (jika dipilih)

**Total time:** ~2-3 menit ☕

### Non-Interactive Mode

Untuk CI/CD atau automation, gunakan flags untuk skip prompts:

```bash
php artisan bangkah:create --yes [options]
```

Flag `--yes` akan use defaults untuk semua options yang tidak disebutkan.

#### Examples:

**API Project dengan Docker:**
```bash
php artisan bangkah:create --type=api --docker --nginx --db=postgres --yes
```

**Web Project tanpa Docker:**
```bash
php artisan bangkah:create --type=web --frontend=tailwind --auth --yes
```

**Minimal Setup:**
```bash
php artisan bangkah:create --type=web --frontend=none --yes
```

### Command Options

| Option | Values | Default | Description |
|--------|--------|---------|-------------|
| `--type` | `web`, `api` | `web` | Project template type |
| `--docker` | flag | `false` | Install Docker configuration |
| `--nginx` | flag | `false` | Install Nginx configuration |
| `--db` | `mysql`, `postgres` | `mysql` | Database type |
| `--frontend` | `tailwind`, `bootstrap`, `none` | `tailwind` | Frontend framework |
| `--auth` | flag | `false` | Install authentication scaffolding |
| `--yes` | flag | `false` | Non-interactive mode (use defaults) |

#### Option Combinations

Some options work together:

- `--docker` + `--nginx` = Full containerized setup
- `--auth` + `--frontend=tailwind` = Laravel Breeze
- `--auth` + `--frontend=bootstrap` = Laravel UI
- `--type=api` + `--frontend=none` = Headless API (recommended)

---

## 💡 Examples

### Example 1: Full-Stack Web Application

**Goal:** Web app dengan Docker, Nginx, MySQL, Tailwind, dan Authentication

```bash
php artisan bangkah:create \
  --type=web \
  --docker \
  --nginx \
  --db=mysql \
  --frontend=tailwind \
  --auth \
  --yes
```

**Generated Files:**
```
✓ Dockerfile
✓ docker-compose.yml
✓ docker/nginx/default.conf
✓ app/Http/Controllers/HomeController.php
✓ resources/views/home.blade.php
✓ routes/web.php (with home route)
✓ .env (configured for MySQL)
✓ Laravel Breeze installed
✓ Tailwind CSS configured
```

**What You Get:**
- 🏠 Modern homepage at `/`
- 🔐 Auth routes: `/login`, `/register`, `/dashboard`
- 🐳 3 Docker containers: app, mysql, nginx
- 🎨 Tailwind CSS pre-configured
- ⚡ Assets built and ready

**Next Steps:**
```bash
# Start containers
docker compose up -d

# Run migrations
docker compose exec app php artisan migrate

# Access application
open http://localhost
```

---

### Example 2: RESTful API with PostgreSQL

**Goal:** API-only dengan Docker, PostgreSQL, no frontend

```bash
php artisan bangkah:create \
  --type=api \
  --docker \
  --nginx \
  --db=postgres \
  --frontend=none \
  --yes
```

**Generated Files:**
```
✓ Dockerfile
✓ docker-compose.yml (with PostgreSQL)
✓ app/Http/Controllers/Api/HealthController.php
✓ routes/api.php (with /api/health endpoint)
✓ bootstrap/app.php (API routes enabled)
✓ .env (configured for PostgreSQL)
```

**API Endpoint:**

Test health endpoint:
```bash
curl http://localhost/api/health
```

**Response:**
```json
{
  "status": "ok",
  "message": "API is running",
  "app": "MyApp",
  "environment": "local",
  "laravel": "12.42.0",
  "php": "8.4.1",
  "time": "2025-12-15T10:30:00.000000Z"
}
```

**Next Steps:**
```bash
# Start containers
docker compose up -d

# Run migrations
docker compose exec app php artisan migrate

# Test API
curl -X GET http://localhost/api/health
```

---

### Example 3: Traditional Bootstrap Web App

**Goal:** Simple web app dengan Bootstrap, MySQL, tanpa Docker

```bash
php artisan bangkah:create \
  --type=web \
  --frontend=bootstrap \
  --auth \
  --db=mysql \
  --yes
```

**Generated Files:**
```
✓ app/Http/Controllers/HomeController.php
✓ resources/views/home.blade.php
✓ routes/web.php
✓ .env (MySQL configuration)
✓ Laravel UI installed
✓ Bootstrap CSS included
```

**What You Get:**
- 🏠 Homepage with Bootstrap styling
- 🔐 Laravel UI auth scaffolding
- 💾 MySQL configured in .env

**Next Steps:**
```bash
# Configure database in .env
# Then run:
php artisan migrate

# Start dev server
php artisan serve

# Access at http://localhost:8000
```

---

### Example 4: Minimal Setup (No Docker, No Auth)

**Goal:** Bare minimum untuk quick prototyping

```bash
php artisan bangkah:create \
  --type=web \
  --frontend=none \
  --yes
```

**Generated Files:**
```
✓ app/Http/Controllers/HomeController.php
✓ resources/views/home.blade.php
✓ routes/web.php
```

**What You Get:**
- 🏠 Basic homepage
- 🎯 Web routes configured
- 🚀 Ready to build

Perfect untuk:
- Quick prototypes
- Learning Laravel
- Custom frontend (React, Vue, Alpine)

---

## 🎨 Templates

### Web Template

**Purpose:** Traditional web applications with server-rendered views

**Includes:**
- `app/Http/Controllers/HomeController.php` - Home page controller
- `resources/views/home.blade.php` - Modern gradient homepage
- `routes/web.php` - Web routes with home route

**Homepage Features:**
- 🎨 Modern gradient design (purple/blue)
- 📱 Fully responsive
- 💳 Feature cards showcase
- ⚡ Vite integration ready
- 🎯 Call-to-action sections

**Use Cases:**
- E-commerce websites
- Business websites
- Content management systems
- Admin dashboards
- Marketing websites

---

### API Template

**Purpose:** RESTful APIs and headless applications

**Includes:**
- `app/Http/Controllers/Api/HealthController.php` - Health check endpoint
- `routes/api.php` - API routes
- `bootstrap/app.php` - API routes enabled for Laravel 12

**Health Endpoint:**
```
GET /api/health
```

**Response Schema:**
```json
{
  "status": "ok|error",
  "message": "API is running",
  "app": "string",
  "environment": "string",
  "laravel": "string",
  "php": "string",
  "time": "ISO8601 datetime"
}
```

**Features:**
- ✅ CORS pre-configured
- ✅ API versioning ready
- ✅ JSON responses
- ✅ Rate limiting configured
- ✅ Exception handling

**Use Cases:**
- Mobile app backends
- SPA backends (React, Vue, Angular)
- Microservices
- Third-party integrations
- IoT platforms

---

## 🐳 Docker Configuration

### Generated Docker Files

When you enable Docker, Bangkah generates:

```
Dockerfile                    # Application container
docker-compose.yml           # Multi-container orchestration
docker/nginx/default.conf    # Nginx configuration
```

### Services Architecture

```
┌─────────────────┐     ┌─────────────────┐     ┌─────────────────┐
│   Nginx         │────▶│   Laravel App   │────▶│   Database      │
│   Port 80       │     │   PHP 8.2-FPM   │     │   MySQL/Postgres│
└─────────────────┘     └─────────────────┘     └─────────────────┘
       │                        │                        │
       └────────────────────────┴────────────────────────┘
                        Docker Network
```

### Dockerfile Details

**Base Image:** `php:8.2-fpm`

**Installed Extensions:**
- pdo
- pdo_mysql
- pdo_pgsql

**Tools Included:**
- Composer 2.x
- Git
- Zip/Unzip

**Optimization:**
- Multi-stage build ready
- Composer cache optimization
- Non-root user for security

### docker-compose.yml Services

#### App Service
```yaml
app:
  build: .
  container_name: laravel_app
  working_dir: /var/www
  volumes:
    - ./:/var/www
  networks:
    - laravel
  environment:
    - APP_ENV=local
```

#### Database Service (MySQL)
```yaml
mysql:
  image: mysql:8.0
  container_name: mysql_db
  environment:
    MYSQL_DATABASE: laravel
    MYSQL_USER: sail
    MYSQL_PASSWORD: password
    MYSQL_ROOT_PASSWORD: root
  volumes:
    - mysql_data:/var/lib/mysql
  ports:
    - "3306:3306"
```

#### Database Service (PostgreSQL)
```yaml
pgsql:
  image: postgres:16
  container_name: postgres_db
  environment:
    POSTGRES_DB: laravel
    POSTGRES_USER: sail
    POSTGRES_PASSWORD: password
  volumes:
    - pgsql_data:/var/lib/postgresql/data
  ports:
    - "5432:5432"
```

#### Nginx Service
```yaml
nginx:
  image: nginx:latest
  container_name: nginx_server
  ports:
    - "80:80"
  volumes:
    - ./:/var/www
    - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
  depends_on:
    - app
  networks:
    - laravel
```

### Docker Commands

```bash
# Start all services
docker compose up -d

# View logs
docker compose logs -f

# View specific service logs
docker compose logs -f app
docker compose logs -f nginx

# Stop all services
docker compose down

# Restart services
docker compose restart

# Rebuild containers
docker compose up -d --build

# Execute commands in app container
docker compose exec app php artisan migrate
docker compose exec app composer install

# Access app container shell
docker compose exec app bash

# View running containers
docker compose ps

# Remove all containers and volumes
docker compose down -v
```

### Nginx Configuration

**Key Features:**
- FastCGI caching
- Gzip compression (level 6)
- Client max body size: 100M
- Buffer optimization
- Static file caching

**Optimized Routes:**
- Laravel routing via index.php
- Static assets served directly
- Hidden .env and other sensitive files

---

## 💾 Database Setup

### Automatic Configuration

Bangkah automatically configures your `.env` file based on database choice:

### MySQL Configuration

```env
DB_CONNECTION=mysql
DB_HOST=mysql        # or 127.0.0.1 without Docker
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

**MySQL Features:**
- Version 8.0
- UTF8MB4 character set
- InnoDB engine
- Persistent volume `mysql_data`

### PostgreSQL Configuration

```env
DB_CONNECTION=pgsql
DB_HOST=pgsql        # or 127.0.0.1 without Docker
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

**PostgreSQL Features:**
- Version 16
- Advanced features (JSON, Full-Text Search)
- ACID compliance
- Persistent volume `pgsql_data`

### Running Migrations

**With Docker:**
```bash
docker compose exec app php artisan migrate
```

**Without Docker:**
```bash
php artisan migrate
```

### Seeding Database

```bash
# Create seeder
php artisan make:seeder UserSeeder

# Run specific seeder
php artisan db:seed --class=UserSeeder

# Run all seeders
php artisan db:seed
```

### Database GUI Tools

**Recommended Tools:**

- **MySQL**: phpMyAdmin, MySQL Workbench, TablePlus
- **PostgreSQL**: pgAdmin, DBeaver, TablePlus

**Connection Details:**
- Host: `localhost`
- Port: `3306` (MySQL) or `5432` (PostgreSQL)
- User: `sail`
- Password: `password`
- Database: `laravel`

---

## 🔐 Authentication

Bangkah mendukung 2 authentication packages Laravel official:

### Laravel Breeze

**Requirements:** `--frontend=tailwind`

**Command:**
```bash
php artisan bangkah:create --auth --frontend=tailwind --yes
```

**What's Included:**
- ✅ Login & Registration
- ✅ Password Reset
- ✅ Email Verification
- ✅ Profile Management
- ✅ Tailwind CSS Styled
- ✅ Blade Components
- ✅ Mobile Responsive

**Routes Generated:**
```php
/login              // Login page
/register           // Registration page
/forgot-password    // Password reset request
/reset-password     // Password reset form
/verify-email       // Email verification
/dashboard          // User dashboard
/profile            // Profile management
```

**Features:**
- Minimal & clean UI
- Modern Tailwind design
- SPA-ready (optional Inertia.js)
- Two-factor authentication ready

---

### Laravel UI

**Requirements:** `--frontend=bootstrap`

**Command:**
```bash
php artisan bangkah:create --auth --frontend=bootstrap --yes
```

**What's Included:**
- ✅ Login & Registration
- ✅ Password Reset
- ✅ Remember Me
- ✅ Bootstrap 5 Styled
- ✅ Vue.js scaffolding option
- ✅ Traditional blade views

**Routes Generated:**
```php
/login              // Login page
/register           // Registration page
/password/reset     // Password reset
/home               // Home after login
```

**Features:**
- Classic Bootstrap design
- Comprehensive auth flow
- Compatible with older projects
- Vue.js integration option

---

### Post-Installation Steps

After installing authentication:

1. **Run Migrations:**
   ```bash
   php artisan migrate
   ```

2. **Configure Email:** (for password reset)
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=your_username
   MAIL_PASSWORD=your_password
   ```

3. **Test Registration:**
   - Visit `/register`
   - Create test account
   - Verify login works

4. **Customize Views:**
   - Breeze views: `resources/views/auth/`
   - UI views: `resources/views/auth/`

---

## ⚡ Frontend Assets

### Auto Build

Bangkah automatically builds your frontend assets after:
- NPM package installation
- Authentication scaffolding
- Frontend framework installation

No need to manually run `npm run build`!

### Manual Build

If needed, you can rebuild assets manually:

```bash
# Production build
npm run build

# Development build (with watch)
npm run dev
```

### Frontend Frameworks

#### Tailwind CSS

**Configuration:** `tailwind.config.js`

```javascript
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

**CSS Entry:** `resources/css/app.css`

```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

**Build Output:** `public/build/assets/`

---

#### Bootstrap

**Version:** 5.3+

**Installation:** Via NPM in `package.json`

```json
{
  "devDependencies": {
    "bootstrap": "^5.3",
    "@popperjs/core": "^2.11"
  }
}
```

**Import:** `resources/js/app.js`

```javascript
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
```

---

#### No Frontend

Perfect for:
- API-only applications
- Headless CMS
- Custom frontend (React, Vue external)
- Mobile app backends

**Build:** None required

---

### Vite Configuration

**File:** `vite.config.js`

```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
```

**Hot Module Replacement:**

```bash
# Terminal 1: Vite dev server
npm run dev

# Terminal 2: Laravel dev server
php artisan serve
```

Access at `http://localhost:8000` with hot reload!

---

## 🚀 Deployment

### Pre-Deployment Checklist

Before deploying to production:

- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Generate production `APP_KEY`
- [ ] Configure production database
- [ ] Set up proper `MAIL_*` credentials
- [ ] Configure `QUEUE_CONNECTION` (redis/database)
- [ ] Set `SESSION_DRIVER` (redis/database)
- [ ] Update `APP_URL` to production domain
- [ ] Configure SSL/HTTPS
- [ ] Set up proper logging

---

### Laravel Optimization

Run these commands for production optimization:

```bash
# 1. Install production dependencies only
composer install --optimize-autoloader --no-dev

# 2. Cache configuration
php artisan config:cache

# 3. Cache routes
php artisan route:cache

# 4. Cache views
php artisan view:cache

# 5. Cache events
php artisan event:cache

# 6. Build frontend assets
npm run build

# 7. Run migrations
php artisan migrate --force

# 8. Link storage
php artisan storage:link
```

**Clear Cache When Needed:**
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

---

### Docker Production Setup

#### Update docker-compose.yml for Production

```yaml
services:
  app:
    build:
      context: .
      target: production
    environment:
      - APP_ENV=production
      - APP_DEBUG=false
    restart: unless-stopped

  mysql:
    environment:
      MYSQL_ROOT_PASSWORD: ${DB_ROOT_PASSWORD}
      MYSQL_PASSWORD: ${DB_PASSWORD}
    restart: unless-stopped
    
  nginx:
    restart: unless-stopped
```

#### Multi-Stage Dockerfile

Add production stage:

```dockerfile
# Production stage
FROM php:8.2-fpm as production

# Copy only necessary files
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . /var/www
WORKDIR /var/www

# Install production dependencies
RUN composer install --optimize-autoloader --no-dev

# Optimize Laravel
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
```

#### Build for Production

```bash
docker compose -f docker-compose.prod.yml up -d --build
```

---

### Deployment Platforms

#### Deploy to DigitalOcean

```bash
# Install doctl CLI
snap install doctl

# Authenticate
doctl auth init

# Create droplet
doctl compute droplet create laravel-app \
  --image ubuntu-22-04-x64 \
  --size s-2vcpu-2gb \
  --region sgp1

# SSH into droplet
ssh root@your-droplet-ip

# Clone your repository
git clone your-repo.git
cd your-repo

# Run Docker Compose
docker compose up -d
```

#### Deploy to AWS EC2

1. Create EC2 instance (Ubuntu 22.04)
2. Install Docker & Docker Compose
3. Configure security groups (ports 80, 443)
4. Deploy with Docker Compose
5. Configure Route 53 for domain
6. Set up Application Load Balancer (optional)

#### Deploy to Laravel Forge

```bash
# Forge handles everything:
# - Server provisioning
# - SSL certificates
# - Deployments
# - Queue workers
# - Scheduled tasks

# Just push to your repository and Forge deploys automatically
git push origin main
```

---

### SSL/HTTPS Setup

#### With Nginx (Let's Encrypt)

```bash
# Install certbot
apt-get install certbot python3-certbot-nginx

# Obtain certificate
certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Auto-renewal is set up automatically
```

#### With Cloudflare

1. Add your domain to Cloudflare
2. Enable "Full (strict)" SSL mode
3. Update your nameservers
4. Cloudflare handles SSL automatically

---

### Environment Variables

**Production .env example:**

```env
APP_NAME=YourApp
APP_ENV=production
APP_KEY=base64:generated_key_here
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=production_db
DB_USERNAME=prod_user
DB_PASSWORD=strong_password_here

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your_sendgrid_api_key
MAIL_ENCRYPTION=tls

LOG_CHANNEL=stack
LOG_LEVEL=error
```

---

### Monitoring & Logging

**Recommended Tools:**
- **Monitoring**: Laravel Telescope, New Relic, Datadog
- **Error Tracking**: Sentry, Bugsnag, Rollbar
- **Uptime**: UptimeRobot, Pingdom
- **Logs**: Papertrail, Loggly, CloudWatch

**Setup Sentry:**

```bash
composer require sentry/sentry-laravel
php artisan sentry:publish --dsn=your_dsn_here
```

---

## 🔧 Troubleshooting

### Common Issues

#### Issue 1: Command Not Found

**Problem:**
```bash
php artisan bangkah:create
# Command "bangkah:create" is not defined.
```

**Solution:**
```bash
# Clear cache
php artisan clear-compiled
php artisan cache:clear

# Re-install package
composer dump-autoload
composer require bangkah/bangkah
```

---

#### Issue 2: Docker Containers Not Starting

**Problem:**
```bash
docker compose up -d
# Error: port already in use
```

**Solution:**
```bash
# Check what's using the port
lsof -i :80

# Stop conflicting service
sudo systemctl stop apache2  # or nginx

# Or change port in docker-compose.yml
ports:
  - "8080:80"
```

---

#### Issue 3: Permission Denied (Docker)

**Problem:**
```bash
# Permission denied for storage/
```

**Solution:**
```bash
# Fix permissions
docker compose exec app chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
docker compose exec app chmod -R 775 /var/www/storage /var/www/bootstrap/cache
```

---

#### Issue 4: NPM Build Fails

**Problem:**
```bash
npm run build
# Error: Cannot find module 'vite'
```

**Solution:**
```bash
# Remove node_modules and reinstall
rm -rf node_modules package-lock.json
npm install
npm run build
```

---

#### Issue 5: Database Connection Failed

**Problem:**
```
SQLSTATE[HY000] [2002] Connection refused
```

**Solution:**

**With Docker:**
```bash
# Make sure containers are running
docker compose ps

# Check DB host in .env
DB_HOST=mysql  # NOT 127.0.0.1 with Docker
```

**Without Docker:**
```bash
# Check MySQL is running
sudo systemctl status mysql

# Test connection
mysql -u sail -p
```

---

#### Issue 6: API Routes Not Working (404)

**Problem:**
```bash
curl http://localhost/api/health
# 404 Not Found
```

**Solution:**

Laravel 12 requires explicit API route enabling:

```bash
# Check if bootstrap/app.php has API routes enabled
# Should contain:
->withRouting(
    api: __DIR__.'/../routes/api.php',  # This line needed
    web: __DIR__.'/../routes/web.php',
)

# If missing, run Bangkah again with API template
php artisan bangkah:create --type=api --yes
```

---

#### Issue 7: Assets Not Loading

**Problem:**
```
GET http://localhost/build/assets/app.css 404
```

**Solution:**
```bash
# Build assets
npm run build

# Check if files exist
ls public/build/assets/

# If using Vite dev server:
npm run dev
# Make sure @vite directive in blade:
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

---

### Getting Help

If you're still stuck:

1. **Check Laravel Logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **Enable Debug Mode:**
   ```env
   APP_DEBUG=true
   APP_ENV=local
   ```

3. **Check Docker Logs:**
   ```bash
   docker compose logs -f
   ```

4. **Open an Issue:**
   Visit [GitHub Issues](https://github.com/Bangkah/bangkah-launcher/issues)

---

## ❓ FAQ

### General Questions

**Q: Apa perbedaan Bangkah dengan Laravel Breeze/Jetstream?**

A: Bangkah adalah **scaffolding tool**, bukan starter kit yang opinionated. Bangkah membantu setup infrastructure (Docker, Nginx, DB, Frontend), sedangkan Breeze/Jetstream fokus pada authentication dan application features.

Anda bisa menggunakan Bangkah **bersamaan** dengan Breeze/Jetstream!

---

**Q: Apakah Bangkah mengganti file existing?**

A: Ya, Bangkah akan **override** beberapa files:
- `.env` (database credentials)
- `routes/web.php` atau `routes/api.php`
- `bootstrap/app.php` (untuk API routes)

Selalu **backup** project Anda sebelum menjalankan Bangkah!

---

**Q: Bisakah saya use Bangkah di project Laravel lama?**

A: Ya, tapi hati-hati. Bangkah tested di Laravel 11 & 12. Untuk versi lama, mungkin perlu adjustment manual.

---

**Q: Apakah Bangkah free?**

A: Ya! Bangkah adalah **100% free** dan open-source (MIT License).

---

### Technical Questions

**Q: Kenapa npm run build dijalankan otomatis?**

A: Untuk convenience. Frontend assets langsung ready tanpa manual build. Jika tidak suka, Anda bisa skip dengan `--frontend=none`.

---

**Q: Bisakah saya customize templates?**

A: Ya! Templates ada di `vendor/bangkah/bangkah/stubs/`. Anda bisa publish dan modify:
```bash
php artisan vendor:publish --tag=bangkah-stubs
```

---

**Q: Apakah Docker wajib?**

A: Tidak. Docker optional. Anda bisa skip dengan tidak menggunakan flag `--docker`.

---

**Q: Support Laravel 11?**

A: Ya, Bangkah support Laravel 11 & 12.

---

**Q: Apakah bisa pakai database lain selain MySQL/PostgreSQL?**

A: Secara default hanya MySQL & PostgreSQL. Untuk SQLite, MariaDB, atau SQL Server, Anda perlu configure manual di `.env` dan `docker-compose.yml`.

---

**Q: Bagaimana cara update Bangkah?**

A:
```bash
composer update bangkah/bangkah
```

---

**Q: Apakah ada conflict dengan package lain?**

A: Bangkah dirancang non-intrusive. Tidak ada conflict dengan package popular seperti Livewire, Inertia, Filament, dll.

---

## 🛠️ Development

### Local Development

Jika Anda ingin contribute atau develop Bangkah locally:

```bash
# Clone repository
git clone https://github.com/Bangkah/bangkah-launcher.git
cd bangkah-launcher

# Install dependencies
composer install

# Run tests
./vendor/bin/phpunit
```

---

### Testing Your Changes

```bash
# Create test Laravel project
composer create-project laravel/laravel test-project
cd test-project

# Require Bangkah from local path
composer config repositories.bangkah path ../bangkah
composer require bangkah/bangkah @dev

# Test command
php artisan bangkah:create
```

---

### Project Structure

```
bangkah/
├── src/
│   ├── Commands/
│   │   └── StarterCreateCommand.php    # Main command
│   ├── Services/
│   │   ├── TemplateService.php         # Template handling
│   │   ├── DockerService.php           # Docker generation
│   │   ├── DependencyInstaller.php     # Package installation
│   │   └── EnvironmentService.php      # .env configuration
│   └── BangkahServiceProvider.php      # Service provider
├── stubs/
│   ├── web/                            # Web template stubs
│   ├── api/                            # API template stubs
│   └── nginx/                          # Nginx config stubs
├── tests/
│   └── Feature/
│       └── StarterCreateCommandTest.php
├── composer.json
└── README.md
```

---

### Running Tests

```bash
# Run all tests
./vendor/bin/phpunit

# Run specific test
./vendor/bin/phpunit --filter StarterCreateCommandTest

# With coverage
./vendor/bin/phpunit --coverage-html coverage
```

---

### Code Style

Bangkah mengikuti PSR-12 coding standards:

```bash
# Check code style
./vendor/bin/phpcs

# Fix code style
./vendor/bin/phpcbf
```

---

## 🚀 Advanced Usage

### Custom Templates

#### Create Custom Template

1. **Publish stubs:**
   ```bash
   php artisan vendor:publish --tag=bangkah-stubs
   ```

2. **Edit stubs:**
   ```bash
   # Stubs copied to:
   resources/bangkah/stubs/
   ```

3. **Modify as needed:**
   - Add new controllers
   - Customize views
   - Add custom routes

---

### Extending Services

#### Custom Template Service

```php
namespace App\Services;

use Bangkah\Starter\Services\TemplateService;

class CustomTemplateService extends TemplateService
{
    public function applyCustomTemplate(string $basePath): void
    {
        // Your custom logic
        $this->copyController($basePath, 'CustomController');
        $this->copyView($basePath, 'custom.blade.php');
    }
}
```

#### Register in Service Provider

```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CustomTemplateService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CustomTemplateService::class);
    }
}
```

---

### Programmatic Usage

Use Bangkah services programmatically:

```php
use Bangkah\Starter\Services\TemplateService;
use Bangkah\Starter\Services\DockerService;

// Get services from container
$templateService = app(TemplateService::class);
$dockerService = app(DockerService::class);

// Use services
$templateService->applyWeb(base_path());
$dockerService->generateDockerFiles(base_path(), 'mysql', true);
```

---

## 🤝 Contributing

We welcome contributions! Here's how you can help:

### Ways to Contribute

1. **Report Bugs**: Open an issue with detailed information
2. **Suggest Features**: Share your ideas via issues
3. **Submit PRs**: Fix bugs or add features
4. **Improve Docs**: Fix typos, add examples, clarify instructions
5. **Share**: Tell others about Bangkah!

### Contribution Guidelines

1. **Fork the repository**
2. **Create a feature branch**
   ```bash
   git checkout -b feature/amazing-feature
   ```

3. **Make your changes**
   - Follow PSR-12 coding standards
   - Add tests for new features
   - Update documentation

4. **Run tests**
   ```bash
   ./vendor/bin/phpunit
   ```

5. **Commit your changes**
   ```bash
   git commit -m "Add amazing feature"
   ```

6. **Push to branch**
   ```bash
   git push origin feature/amazing-feature
   ```

7. **Open Pull Request**
   - Describe your changes
   - Link related issues
   - Add screenshots if UI changes

### Code of Conduct

- Be respectful and inclusive
- Help newcomers
- Give constructive feedback
- Focus on the code, not the person

---

## 📝 Changelog

### Version 1.0.0 (2025-12-15)

**Initial Release**

**Features:**
- ✨ Interactive CLI command
- ✨ Web & API templates
- ✨ Docker + Nginx support
- ✨ MySQL & PostgreSQL support
- ✨ Tailwind & Bootstrap support
- ✨ Laravel Breeze & UI integration
- ✨ Auto frontend build
- ✨ Laravel 12 compatibility

**Documentation:**
- 📚 Complete README
- 📚 Usage examples
- 📚 Troubleshooting guide
- 📚 FAQ section

---

## 📄 License

Bangkah is open-sourced software licensed under the **MIT License**.

```
MIT License

Copyright (c) 2025 Atha

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

## 👨‍💻 Author

**Muhammad Dhiyaul Atha**

- GitHub: [@Bangkah](https://github.com/Bangkah)
- Organization: [Bangkah](https://github.com/Bangkah)

---

## 🙏 Acknowledgments

Special thanks to:

- **Laravel Team** - For the amazing framework
- **Taylor Otwell** - Creator of Laravel
- **Tailwind CSS** - For the utility-first CSS framework
- **Bootstrap Team** - For the responsive framework
- **Docker Community** - For containerization tools
- **Open Source Community** - For inspiration and support

Built with ❤️ and ☕ by developers, for developers.

---

## 🔗 Links

- **Documentation**: [Full Docs](#)
- **GitHub**: [Repository](https://github.com/Bangkah/bangkah-launcher)
- **Issues**: [Bug Reports](https://github.com/Bangkah/bangkah-launcher)
- **Discussions**: [Community](https://github.com/Bangkah/bangkah-launcher/discussions)
- **Laravel**: [laravel.com](https://laravel.com)

---

## 🌟 Show Your Support

If you find Bangkah helpful, please:

- ⭐ Star the repository
- 🐦 Share on Twitter
- 📝 Write a blog post
- 💬 Tell your friends

Every bit helps make Bangkah better!

---

<div align="center">

**Happy Coding!** 🚀

Made with ☕, 💻, and ❤️

</div>
