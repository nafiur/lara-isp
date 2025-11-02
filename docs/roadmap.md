# ISP Management System – Implementation Roadmap

This roadmap breaks the build into incremental milestones. Each milestone ships a coherent slice of functionality while laying the foundation for later work.

## Milestone 1 – Platform Foundations

- 1.1 Configure multi-company/branch schema (organizations, branches, tenant context middleware).
- 1.2 Seed core roles/permissions (super admin, branch admin, billing ops, network engineer, support).
- 1.3 Implement global settings module (billing cycle defaults, Mikrotik credentials, SMS providers).
- 1.4 Harden authentication: enforce email verification, password policies, 2FA placeholder.
- 1.5 Set up Horizon, queue workers, health checks, and logging dashboards.

## Milestone 2 – CRM & Customer Lifecycle

- 2.1 Domain models for customers, resellers, service addresses, contacts.
- 2.2 Lead intake + conversion workflow with tagging and assignment.
- 2.3 Customer onboarding wizard (plan selection, router provisioning intent).
- 2.4 Activity timeline leveraging spatie/laravel-activitylog.
- 2.5 REST/JSON APIs for partner integrations (token-guarded with Sanctum).

## Milestone 3 – Billing Engine

- 3.1 Product catalog: service plans, add-ons, discounts, taxation rules.
- 3.2 Subscription lifecycle (activation, suspension, upgrade/downgrade).
- 3.3 Invoice generation jobs, PDF export, email/SMS reminders.
- 3.4 Payment allocation, receipts, and ledger entries.
- 3.5 Dunning strategy (automated retries, grace periods, suspension hooks).

## Milestone 4 – Payments & Accounting

- 4.1 Integrate SSLCommerz + webhooks; queue payment confirmations.
- 4.2 Add bKash, Nagad, and aamarPay adapters behind a unified gateway service.
- 4.3 Reconciliation dashboard and dispute workflows.
- 4.4 Accounting export (CSV/XLSX) and QuickBooks-friendly mappings.

## Milestone 5 – Network Provisioning

- 5.1 Mikrotik RouterOS service layer (API client, DTOs, response handling).
- 5.2 Job orchestration for PPPoE/Hotspot user provisioning and sync.
- 5.3 Router heartbeat checks, auto-disable on delinquency, audit logs.
- 5.4 Support for bulk actions (mass suspend/reactivate).

## Milestone 6 – Inventory & Procurement

- 6.1 Warehouses/branches inventory, stock movement ledger.
- 6.2 Purchase orders, vendor management, and GRN workflows.
- 6.3 Fast assignment of CPE devices to subscribers with QR/barcode support.
- 6.4 Low stock alerts and reorder suggestions.

## Milestone 7 – Automation & Reporting

- 7.1 Scheduler definitions for recurring jobs (billing cycles, sync, reminders).
- 7.2 Notification channels (SMS, email, push) with templating.
- 7.3 KPI dashboards using ApexCharts/Laravel-Trend.
- 7.4 SLA monitoring, uptime health checks, and incident log.

## Milestone 8 – Hardening & Launch

- 8.1 Pen-test fixes, audit trail review, GDPR-ready data export/delete.
- 8.2 Observability: log aggregation rules, alerting policies, disaster recovery plan.
- 8.3 CI/CD pipeline (tests, lint, build, deploy) and infrastructure-as-code baselines.
- 8.4 Launch readiness checklist and cutover runbook.

Review and adjust milestones after each iteration based on stakeholder feedback and capacity. Track granular issues in your preferred PM tool linked back to these milestones.
