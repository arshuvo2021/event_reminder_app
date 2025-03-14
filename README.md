
# Event Reminder App

## 📌 Overview
The **Event Reminder App** is a Laravel-based application that allows users to create, manage, and receive reminders for upcoming events. It supports features like email notifications, event syncing, and participant management.

## 🛠️ Installation

### 1️⃣ Clone the Repository
```sh
git clone https://github.com/arshuvo2021/event_reminder_app.git
cd event-reminder-app
```

### 2️⃣ Install Dependencies
```sh
composer install
npm install  # If frontend dependencies exist
```

### 3️⃣ Configure Environment
Copy the `.env.example` file and rename it to `.env`:
```sh
cp .env.example .env
```
Now, update the **database configuration** in the `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=event_reminder_db
DB_USERNAME=root  # Change if needed
DB_PASSWORD=      # Set your database password
```

Also, configure **email settings** for sending reminders:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Event Reminder App"
```

### 4️⃣ Generate App Key
```sh
php artisan key:generate
```

### 5️⃣ Run Migrations & Seed Database
```sh
php artisan migrate --seed
```

### 6️⃣ Start Local Development Server
```sh
php artisan serve
```
Now, open [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser.

## ⏰ Scheduling Reminder Emails
Laravel's scheduler is used to send email reminders. Run the scheduler manually:
```sh
php artisan schedule:run
```
For automatic execution, add the following line to your **crontab**:
```sh
* * * * * php /path-to-project/artisan schedule:run >> /dev/null 2>&1
```

## 🛠 Additional Commands
- **Clear Cache**: `php artisan cache:clear`
- **Run Queued Jobs**: `php artisan queue:work`
- **Tinker (Test Application Code)**: `php artisan tinker`

## ✅ Features Implemented
✔ Event CRUD (Create, Read, Update, Delete)
✔ Participant Management
✔ Email Reminders for Events
✔ CSV Import for Bulk Event Upload
✔ Event Syncing & Offline Support
✔ Laravel Console Commands & Jobs for Processing
✔ Vue Components for Interactive UI

---
### 📝 Author
**Md Abdur Rahman Shuvo**



