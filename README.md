# ![Laravel Example App](logo.png)

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start LARAVEL VERSION (8.6.9).

Clone the repository

    git clone https://github.com/lalejandrors/news_app.git

Switch to the repo folder

    cd news_app

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Generate a new JWT authentication secret key

    php artisan jwt:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000 or http://127.0.0.1:8000

## Database seeding

Run the sql inserts. Check files "categorias_202312061626" and "noticias_202312061625". It's important to run "categorias" first and then "noticias".

----------