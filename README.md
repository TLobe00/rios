# Todo Project

This Readme is taking into account that whomever clones the repo will already have a Linux server and MySQL database engine.

- Clone this project
- Go to the folder application using `cd` command on your cmd or terminal
- Run `composer install` on your cmd or terminal
- Copy .env.example file to .env on the root folder; `cp .env.example .env`
- Open your .env file and change the database name (DB_DATABASE) to 'laravel', 'root' (DB_USERNAME) and BLANK password (DB_PASSWORD) or whatever corresponds to your MySQL configuration.
- Run `php artisan key:generate`
- Run `php artisan migrate:fresh`
- Run `php artisan serve`

## How to run the application

Open a web browser and navigate to your localhost web server address (i.e. for Valet rios.test) and run through the demo application.

This application DOES NOT take into account any user login but could easily (with Laravel's built in user modules) be converted to allow such fnctionality.

This also uses CDN's for JQuery and JQuery UI but could be made to be self-contained if outside libraries would not be allowed.