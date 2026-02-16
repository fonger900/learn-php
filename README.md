# Laravel Vue Starter Kit (LMS Edition)

A modern, high-performance starter kit for building Learning Management Systems (LMS) or educational platforms, powered by the latest Laravel ecosystem.

## 🚀 Tech Stack

- **Backend:** [Laravel 12](https://laravel.com) (PHP 8.4+)
- **Frontend:** [Vue 3](https://vuejs.org) via [Inertia.js v2](https://inertiajs.com)
- **Styling:** [Tailwind CSS v4](https://tailwindcss.com)
- **Authentication:** [Laravel Fortify](https://laravel.com/docs/fortify) (including 2FA)
- **Real-time:** [Laravel Reverb](https://laravel.com/docs/reverb)
- **Type-safe Routes:** [Laravel Wayfinder](https://github.com/laravel/wayfinder)
- **Testing:** [Pest 4](https://pestphp.com)
- **Code Style:** [Laravel Pint](https://laravel.com/docs/pint)

## ✨ Features

- **Course Management:** Structured hierarchy with Courses, Modules, and Lessons.
- **Student Progression:** Track lesson completion and course enrollment.
- **Modern UI:** Built with Tailwind CSS v4 and a custom Vue component library (located in `resources/js/components`).
- **User Settings:**
    - Profile management (Avatar, Name, Email).
    - Password updates.
    - Two-Factor Authentication (2FA).
    - Appearance settings (Light/Dark/System themes).
- **Developer Experience:**
    - Type-safe route generation for TypeScript via Wayfinder.
    - Real-time event broadcasting with Reverb.
    - SSR support for SEO-friendly pages.

## 🛠️ Getting Started

### Prerequisites

- PHP 8.4+
- Node.js & NPM
- SQLite (or your preferred database)

### Installation

You can use the built-in setup script to get everything ready:

```bash
composer run setup
```

This will:
1. Install PHP dependencies.
2. Create your `.env` file and generate an app key.
3. Run database migrations.
4. Install NPM dependencies and build assets.

### Running the Development Environment

Start all development services (Server, Queue, Vite, Reverb) with a single command:

```bash
npm run dev
# or
composer run dev
```

## 🧪 Testing

Run the test suite using Pest:

```bash
composer run test
# or
php artisan test
```

## 🎨 Project Structure

- `app/Models/`: Contains the core business logic (Course, Module, Lesson, User).
- `resources/js/Pages/`: Vue page components.
- `resources/js/components/`: Reusable UI components.
- `resources/js/actions/`: Type-safe controller actions via Wayfinder.
- `resources/js/routes/`: Type-safe named routes via Wayfinder.

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
