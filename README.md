# Corporate Website & Content Management System

[![Company CMS CI](https://github.com/ra1ya/company/actions/workflows/ci.yml/badge.svg)](https://github.com/ra1ya/company/actions/workflows/ci.yml)
[![Laravel 11](https://img.shields.io/badge/Laravel-11-red.svg)](https://laravel.com/)
[![PHP 8.2+](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)](https://www.php.net/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

A Laravel-based corporate website with a protected administration CMS for managing public website content. The project demonstrates practical CRUD workflows, file uploads, admin authentication, validation, contact handling, and automated verification.

## Recruiter Snapshot

- Laravel 11 / PHP 8.2 application with MySQL or SQLite support
- Protected administrator area using a dedicated `admin` authentication guard
- Public administrator self-registration disabled
- Rate-limited administrator login
- CMS management for services, company profile, FAQs, news, clients, team members, and testimonials
- Image upload replacement and cleanup through Laravel Storage
- Public contact form with validation, throttling, and Laravel Mail delivery
- Repeatable migrations and sanitized demo administrator seeding
- GitHub Actions verifies PHP syntax, migrations, seeders, routes, Blade compilation, tests, and frontend build

## Main Workflows

### Public Website

The home page renders content stored by the CMS:

- Company profile
- Services
- Frequently asked questions
- News
- Clients
- Team members
- Testimonials
- Contact form

### Administrator CMS

Authenticated administrators can manage website content through resource-based Laravel controllers. Public admin registration is intentionally not exposed; demo/local access is created by the database seeder.

## Security & Quality

- Dedicated `auth:admin` route protection
- No public admin registration endpoint
- Login rate limiting
- Request validation for CMS create/update actions
- `findOrFail()` for resource lookups
- Uploaded image type and size validation
- Old uploaded files removed when replaced or deleted
- Admin profile updates scoped to the authenticated admin guard
- Password updates verify the current admin password
- CSRF-protected administrator CMS forms
- Legacy public contact action is separately validated and rate limited; its CSRF exception is documented in `SECURITY.md`
- Automated tests and CI

See [SECURITY.md](SECURITY.md) for the security posture and [ARCHITECTURE.md](ARCHITECTURE.md) for a concise architecture overview.

## Tech Stack

- **Backend:** PHP 8.2+, Laravel 11
- **Database:** MySQL / MariaDB or SQLite
- **ORM:** Eloquent
- **Frontend:** Blade, Tailwind/Vite, responsive CSS
- **Authentication:** Laravel session guard (`admin`)
- **Storage:** Laravel public filesystem
- **Mail:** Laravel Mail
- **Testing:** PHPUnit / Laravel Feature Tests
- **CI:** GitHub Actions

## Local Setup

```bash
git clone https://github.com/ra1ya/company.git
cd company
composer install
npm install
cp .env.example .env
php artisan key:generate
```

For the default SQLite setup:

```bash
touch database/database.sqlite
php artisan migrate:fresh --seed
php artisan storage:link
npm run build
php artisan serve
```

The seeded demo administrator uses fictional credentials documented in `database/seeders/AdminSeeder.php`. Change them before any non-demo deployment.

To use MySQL/MariaDB instead, update the `DB_*` values in `.env` and run the same migration/seed command.

## Automated Verification

The CI workflow verifies:

```text
composer validate
composer install
PHP syntax linting
php artisan migrate:fresh --seed
php artisan route:list
php artisan view:cache
php artisan test
npm ci
npm run build
```

## Project Structure

```text
app/
├── Http/Controllers/
│   ├── Admin/
│   ├── ContactController.php
│   └── HomeController.php
├── Http/Requests/Auth/AdminLoginRequest.php
└── Models/

database/
├── migrations/
└── seeders/

resources/views/
├── admin/
└── in.blade.php

routes/
├── web.php
└── admin-auth.php
```

## Portfolio Scope

This project is intentionally presented as a **corporate website + CMS**, not as a large SaaS product. Its portfolio value is in clean Laravel structure, protected administrative workflows, dynamic content management, uploads, validation, and reproducible CI-backed setup.

The public interface is based on the Arsha/BootstrapMade template and is not presented as an original frontend design. The portfolio focus is the Laravel CMS, backend workflows, data handling, authentication, and engineering cleanup.

## License

MIT — see [LICENSE](LICENSE).

## Author

**Rian Aldini**  
Full-Stack Web & Mobile Developer  
Laravel • PHP • MySQL • Flutter
