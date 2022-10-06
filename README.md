Mini news program, where is possible to add, delete
and edit articles and comments for authorized users, add comments with captcha
without logging in,sort articles by date or most commented.

### Used technologies:
- PHP 8.0.19
- Laravel 9.30.1
- Node 16.16
- MariaDB 10.4.24

### To run program enter commands from here:
- clone project from github
- make sure your gd extension for php is enabled
- composer install
- npm install
- npm run build
- fill .env file as in .env.example
- create database
- php artisan migrate
- php artisan db:seed (to add some fake users, articles and comments)
- php artisan key:generate
- php artisan storage:link
- php artisan serve
