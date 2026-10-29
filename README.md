<p align="center">
  <img src="public/logo-drms.jpg" alt="DRMS logo" width="80" height="80">
</p>

# DRMS — Digital Reporting and Monitoring System

A reporting and monitoring system for Bangladesh Police. Police stations enter cases, QRR records, narcotics recoveries, warrants, and women and children cases, and senior officers review and track them on dashboards and charts by division, district, and police station.

Live site: [drmsbslrange.com](https://drmsbslrange.com)

Built with Laravel 9.

## Modules

Each module has a dashboard, add / edit / delete / view screens, a searchable table, OC (Officer-in-Charge) review, and charts.

- **Cases:** case register with type, location, and status, exportable to Excel
- **QRR:** QRR records with summary reports and PDF details
- **Narcotics:** narcotics cases with case number, investigator, and recovered items (ganja, yaba, heroin, phensedyl, alcohol, LSD, and more), plus recovery and case-number reports
- **Warrants:** GR and CR warrants received and executed, recalls, arrests, and case disposals
- **Women and children:** complaints with complainant and accused details, GD and case numbers, sections of law, and investigator
- **Areas:** division, district, circle, police station (thana), and upazila
- **Users and roles:** role-based permissions per module and action, assigned from the admin screen
- **Authentication:** login, password reset, email verification, password confirmation, and profile editing
- Excel exports (Laravel Excel) and printable PDF views

## Tech stack

| Layer    | Packages                                                     |
| -------- | ------------------------------------------------------------ |
| Backend  | PHP 8.0+, Laravel 9, Laravel UI, Sanctum                     |
| Access   | Spatie Laravel Permission                                    |
| Tables   | Yajra DataTables (with buttons and export)                   |
| Exports  | Maatwebsite Excel                                            |

## Getting started

### Requirements

- PHP 8.0+
- Composer
- MySQL

### Installation

```bash
git clone https://github.com/mmrtonmoybd/drms-police-reporting-system.git
cd drms-police-reporting-system

composer install
cp .env.example .env
php artisan key:generate
# set the DB_* and MAIL_* values in .env
```

The migrations in this repo only create the users, sessions, and permission tables. The module tables (cases, QRR, narcotics, warrants, women and children, and areas) come from a SQL dump that is **not** in the repository. Import that dump into your database with phpMyAdmin or the `mysql` client, then run:

```bash
php artisan migrate
php artisan storage:link
```

### Run locally

```bash
php artisan serve
```

## Authors

- **Moshiur Rahman Tonmoy** — backend, PHP and Laravel ([rmedha037@gmail.com](mailto:rmedha037@gmail.com))
- **Shoaib Bin Habib Rashad** — frontend
