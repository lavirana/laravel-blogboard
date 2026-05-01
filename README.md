# Laravel BlogBoard

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white)
![License](https://img.shields.io/badge/license-MIT-green?style=flat)

A full-stack **Blog + Job Board** application built with Laravel.  
This project was built as a hands-on learning project to practice  
**every single Laravel Artisan command** in a real-world context.

## ✨ Features

-   Blog with categories, tags, comments & soft deletes
-   Job board with applications
-   Authentication & role-based policies
-   Mail & database notifications
-   Queue jobs & task scheduling
-   REST API with API Resources
-   Feature & unit tests

## Tech Stack

-   **Backend:** Laravel 11, PHP 8.2
-   **Database:** SQLite (dev) / MySQL (prod)
-   **Queue:** Database driver
-   **Auth:** Laravel Sanctum (API)

## Getting Started

\`\`\`bash
git clone https://github.com/lavirana/laravel-blogboard.git
cd laravel-blogboard
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
\`\`\`
