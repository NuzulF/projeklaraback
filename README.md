<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Quick Start

1. clone the repo `git clone https://gitd3ti.vokasi.uns.ac.id/rafaelkurniawan/pbl_promosi.git`
2. run `cd pbl_promosi`
3. run `composer install`
4. run `cp .env.example .env`
5. run `nano .env`
-   change DB_DATABASE, DB_USERNAME, DB_PASSWORD
-   add `MIDTRANS_MERCHANT_ID=your_midtrans_merchant_id` to .env
-   add `MIDTRANS_CLIENT_KEY=your_midtrans_client_key` to .env
-   add `MIDTRANS_SERVER_KEY=your_midtrans_server_key` to .env
-   add `GOOGLE_CLIENT_ID=your_google_client_id` to .env
-   add `GOOGLE_CLIENT_SECRET=your_google_client_secret` to .env
-   add `GOOGLE_CLIENT_REDIRECT=your_google_client_redirect` to .env
6. run `php artisan migrate`
7. run `php artisan db:seed`
17. run `php artisan key:generate`
18. run `php artisan serve`
