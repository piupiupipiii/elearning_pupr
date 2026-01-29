# E-Learning PUPR - Sistem Manajemen Keselamatan Konstruksi (SMKK)

A professional web-based learning management system (LMS) developed for the **Kementerian Pekerjaan Umum dan Perumahan Rakyat (PUPR)**. This platform provides interactive construction safety management training through structured modules and assessments.

---

## 🚀 Overview

The **E-Learning PUPR** system is designed to streamline the learning process for construction safety officers and students. It features a modern, responsive interface with interactive elements such as parallax scrolling and dynamic content delivery.

### Key Features
- **Curated Learning Paths**: Organized sections (Seksi) for a structured learning experience.
- **Interactive Quizzes**: Comprehensive assessments to evaluate comprehension, featuring real-time feedback and scoring.
- **Progress Tracking**: Automatic material unlocking and completion marking.
- **Modern UI/UX**: Custom-built interface using Vanilla CSS with high-performance animations (Lottie).
- **Secure Authentication**: Robust user registration and login system.

---

## 🛠️ Technology Stack

| Layer | Technology |
| :--- | :--- |
| **Backend** | PHP 8.x, Laravel 11.x |
| **Frontend** | Blade Templating Engine, Vanilla CSS, Vanilla JS |
| **Database** | MySQL / MariaDB |
| **Animation** | Lottie Framework |
| **Dev Environment** | Laragon / XAMPP |

---

## 📋 Prerequisites

Ensure you have the following installed on your local machine:
- **PHP** >= 8.2
- **Composer** (PHP Package Manager)
- **MySQL** or **MariaDB**
- **Laragon** (Recommended) or XAMPP/WAMP

---

## ⚙️ Installation & Setup

1. **Clone the repository**
   ```bash
   git clone [repository-url]
   cd elearning
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Configure Environment**
   - Copy the `.env.example` to `.env`
   - Configure your database credentials in the `.env` file.
   ```bash
   cp .env.example .env
   ```

4. **Generate App Key**
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Start the Application**
   ```bash
   php artisan serve
   ```
   The application will be available at `http://127.0.0.1:8000`

---

## 📂 Project Structure Highlights

- `app/Http/Controllers`: Backend logic for Materials, Quizzes, and User Profile.
- `resources/views`: Blade templates for the landing page, module intro, and student dashboard.
- `public/css`: Custom Vanilla CSS files for a lightweight and responsive design.
- `public/js`: Interactive slider and parallax logic.

---

## 📄 License

This project is proprietary and intended for internal use by the **Kementerian Pekerjaan Umum dan Perumahan Rakyat (PUPR)**.
