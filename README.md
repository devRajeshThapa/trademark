# Project Setup Guide

Follow these steps to set up the project environment:

---

## 1. Clone the Repository

```bash
git clone "https://github.com/devRajeshThapa/trademark/"
cd trademark/homedir/public_html/
```

---

## 2. Install Required Software

Make sure you have installed the following:

- PHP (recommended >= 8.1)
- Composer
- Node.js and npm
- MySQL

---

## 3. Setup MySQL Database

Log into MySQL and create the database:

```sql
CREATE DATABASE trademark_database;
```

---

## 4. Configure Environment File

Copy the example environment file:

```bash
cp .env.example .env
```

Edit the `.env` file and update the database credentials:

```dotenv
DB_PORT=database_port_number
DB_DATABASE=database_name
DB_USERNAME=your_mysql_username
DB_PASSWORD=your_mysql_password
```

---

## 5. Install Project Dependencies

Install PHP dependencies via Composer:

```bash
composer install
```

Install Node.js dependencies:

```bash
npm install
```

## 6. Run Migrations and Seed the Database

Run the following command to refresh your database by dropping all tables, running all migrations, and seeding the database:

~~~bash
php artisan migrate:fresh --seed
~~~

> **Note:** If you encounter an error about the `favicons` table already existing (due to duplicate migration files), it means there are conflicting migrations trying to create the same table.

To resolve this, you should:

- Remove or rename any duplicate migration file that attempts to create the `favicons` table.
- If you want to modify the existing `favicons` table, create a new migration for updating it instead of recreating it:

~~~bash
php artisan make:migration update_favicons_table --table=favicons
~~~

This will generate a migration file where you can add your schema changes (e.g., adding or modifying columns) without causing conflicts.

## 7. Start the Development Server

```bash
php artisan serve
```

Visit [http://localhost:8000](http://localhost:8000) to view the app.

---
