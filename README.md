```markdown
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
DB_DATABASE=trademark_database
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

---

## 6. Run Migrations and Seed the Database

```bash
php artisan migrate:fresh --seed
```

---

## 7. Start the Development Server

```bash
php artisan serve
```

Visit [http://localhost:8000](http://localhost:8000) to view the app.

---
```
