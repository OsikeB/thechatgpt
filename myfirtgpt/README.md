# MyFirtGPT Tech CMS

Production-oriented technology CMS foundation using Laravel, PHP, MySQL, Tailwind CSS, Alpine.js, custom JavaScript, Swiper.js, Inter, and Font Awesome.

## Requirements
- PHP 8.3+
- Composer
- Node.js and npm
- MySQL 8+

## Local setup
1. composer install
2. copy .env.example .env
3. php artisan key:generate
4. Configure MySQL credentials in .env
5. php artisan migrate
6. npm install
7. npm run build
8. php artisan serve

Read myfirtgpt/Agents.md before making architectural or security-sensitive changes.