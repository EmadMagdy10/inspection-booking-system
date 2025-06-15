# 🛠️ Inspection Booking System (Laravel)

A modular, multi-tenant inspection booking system built with Laravel HMVC architecture. Designed to allow companies (tenants) to manage teams, set availability, and let users book inspection slots dynamically.

---

## 🔧 Features

- Multi-tenant system with company-based separation
- Registration and authentication using **Laravel Sanctum**
- Role & permission management using **spatie/laravel-permission**
- Modular HMVC architecture using `nwidart/laravel-modules`
- Teams management and availability scheduling
- Dynamic inspection slot generation
- Conflict prevention for overlapping bookings
- Postman Collection for easy API testing


---

## 🧠 Architecture Notes

### 🏢 Multi-Tenancy
This system is designed as a **multi-tenant** SaaS application. Each company (tenant) has isolated access to its own data (teams, availability, bookings, users). This is achieved by scoping all major resources using a `tenant_id`. No data is shared between tenants.

### 🕓 Dynamic Time Slot Generation
When a user requests available booking slots for a specific team and date range, the system:
- Fetches the team's availability (start & end time) for each weekday.
- Iterates through each day in the requested date range.
- Divides the working hours into **1-hour slots** (customizable).
- Checks if the slot overlaps with any existing booking using a conflict check.
- Only returns **available slots** that have no conflicts.

### 🔄 Booking Conflict Prevention
To avoid overlapping bookings:
- The system checks for **any overlap** with existing bookings before allowing a new booking to be created.
- The logic ensures:
  - Slot doesn't start or end during another booking.
  - Slot is not fully within or fully overlapping an existing booking.
- If a conflict is detected, the slot is **marked as unavailable** and not shown to users.

---

## 🧪 Postman API Collection

You can find the Postman collection here:

🔗 [Postman Collection Link](https://limo22-0022.postman.co/workspace/My-Workspace~6393d87d-e3e1-40e2-86a2-fa62eebe87d2/collection/29628666-72aab78e-642a-4197-8c89-965007b6e2dd?action=share&creator=29628666)
  

## 🚀 Setup Instructions

```bash
git clone https://github.com/EmadMagdy10/inspection-booking-system.git
cd inspection-booking-system

# Install dependencies
composer install

# Copy and edit .env
cp .env.example .env
php artisan key:generate

# Set up your DB credentials then run:
php artisan migrate

# Optional: seed with test data
php artisan db:seed

