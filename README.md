# Pharmacy Management System – MVP

A proof-of-concept web application built for a university project.  
The goal was to model key pharmacy workflows—patients, doctors,
medicines, and appointment booking—while sharpening Laravel skills and
practising clean project structure.

---

## ✨ Key Features

| Module | What it does |
| ------ | ------------ |
| **Authentication & Roles** | Custom login/registration with middleware that gates an **Admin** area. |
| **Admin Dashboard** | Ready-made UI template, extended with vanilla JavaScript for instant CRUD on doctors, patients and medicines. |
| **Appointment Booking** | Patients choose a doctor **+** date & time. |
| **Activity Logs** | Every critical action is written to a log table; admins can audit all events from the dashboard. |
| **REST-friendly Architecture** | Route / Controller / Model split with Eloquent ORM for tidy, testable code. |

---

## 🔧 Tech Stack

- **Laravel** – PHP framework & Eloquent ORM  
- **MySQL** – relational database  
- **HTML / CSS** – Blade templates and a pre-built admin theme  
- **Vanilla JavaScript** – dashboard interactions  
- **Composer & NPM** – dependency management

Served as a hands-on exercise in Laravel fundamentals, database design, and front-end integration for a real-world pharmacy scenario.
