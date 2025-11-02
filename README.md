# ISP Management System

Production-grade ISP management platform built with Laravel 11. The application targets multi-company internet providers and delivers CRM, billing automation, network provisioning, inventory, and payment integrations tailored to the Bangladeshi market.

## Feature Scope

- Multi-company and multi-branch tenancy with granular RBAC (Spatie Permission).
- CRM for subscribers, resellers, and prospects with onboarding workflows.
- Automated recurring billing with PDF invoices, SMS/email reminders, and dunning.
- Mikrotik RouterOS integration for PPPoE and Hotspot lifecycle management.
- Local payment gateway support (SSLCommerz, bKash, Nagad, aamarPay).
- Procurement and stock tracking for networking equipment and consumables.
- Scheduler-driven jobs for billing cycles, router sync, and messaging.
- Observability via queues, audit logs, and health checks.

## Technology Stack

| Area | Selection |
| --- | --- |
| Framework | Laravel 11, PHP 8.2 |
| UI | Bootstrap 5, Vite, Blade |
| Auth | Laravel Breeze, Sanctum |
| RBAC | spatie/laravel-permission |
| PDFs | barryvdh/laravel-dompdf |
| Monitoring | spatie/laravel-health |
| Audit | spatie/laravel-activitylog |
| Charts | ApexCharts, Laravel Trend |
| Queue | Redis |

## Getting Started

### Requirements

- PHP 8.2 with required Laravel extensions.
- Composer 2.6+.
- Node.js 20+ and PNPM/Yarn/NPM.
- MySQL 8 (or MariaDB 10.6+), Redis 6+.

### Installation

```bash
cp .env.example .env
composer install
php artisan key:generate
npm install
```

Update `.env` with database, Redis, SMS, and payment credentials. The defaults assume MySQL on `127.0.0.1` and Redis on its standard port.

### Local Development

```bash
php artisan migrate
php artisan serve
npm run dev
```

Background workers and scheduled tasks rely on Redis connections:

```bash
php artisan queue:work
php artisan schedule:work
```

## Domain Structure

Source lives under `app/Domain`, organized by bounded context:

- `Core`: shared contracts, value objects, domain events.
- `CRM`: clients, resellers, leads, onboarding flows.
- `Billing`: plans, subscriptions, invoices, payments, dunning.
- `Network`: Mikrotik integration, provisioning jobs, router sync.
- `Inventory`: procurement, stock control, asset assignments.
- `Payments`: gateway integrations and payment orchestration.
- `Scheduling`: cron definitions, job coordination, automation.
- `Support`: cross-cutting services, traits, helpers.

Each module will expose:

- Eloquent models with typed attributes and query scopes.
- Actions/Services orchestrating use cases.
- HTTP controllers, API resources, and form requests.
- Jobs, listeners, and notifications for async workflows.
- Pest test coverage (unit, feature, integration).

## Roadmap

1. Authentication scaffolding (Breeze + Sanctum) with role seeds.
2. Multi-tenant foundation and company/branch management.
3. CRM module: subscriber lifecycle and contact management.
4. Billing engine: plans, subscriptions, automated invoices.
5. Payment gateway integrations and reconciliation.
6. Mikrotik provisioning services and router sync jobs.
7. Inventory management and procurement workflows.
8. Observability: health checks, activity logs, audit trails.

Track progress via project boards or issues. Contributions should follow PSR-12 and include relevant tests.
