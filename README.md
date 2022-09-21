# Getting started

## Installation

Clone the repository

    git clone git@github.com:ichantzi/XM_exercise.git

Switch to the repo folder

    cd XM_exercise

Install all the dependencies using composer

    composer install

Make the required configuration changes in the .env file by adding the required variables

    RAPID_API_KEY, RAPID_API_URL

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding


Run the database seeder and you're done

    php artisan db:seed --class=CompanySeeder

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh
    


