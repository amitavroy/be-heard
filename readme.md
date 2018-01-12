<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/amitavroy/be-heard"><img src="https://travis-ci.org/amitavroy/be-heard.svg" alt="Build Status"></a>

# Be-heard

Be-heard is a Forum application which I am building using Laravel and Vuejs. This is my initiative to learn Test Driven development. Currently this project is under active development and by no means is this a complete app.

## Installation

To start, first clone the repository

```
git clone https://github.com/amitavroy/be-heard.git
```

Once you have that, copy the .env.example file and make .env file. You need to setup the database configurations, email settings etc. For demo purpose, I strongly suggest that you use Mailtrap.

Once all the configuration is done, we need to pull all the composer packages, so run 

```
composer install
```

And pull all the packages, generate the key and then migrate the database

```
php artisan key:generate
php artisan migrate
```

If you want some default data in the forum, I suggest you add the —seed flag

```
php artisan migrate --seed
```

Once this is done, you should be able to serve the application using

```
php artisan serve
```

And the application will be available on http://localhost:8000 

The default login credentials that I have added in the seed can be found in this file: https://github.com/amitavroy/be-heard/blob/master/database/seeds/UsersTableSeeder.php