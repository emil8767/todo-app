## About the project

This project is built using Laravel and is a task management web application.

## Installation

1. Clone the repository to your computer.
2. Install all dependencies by running the `composer install` command.
3. Create a .env file, copy the contents of the .env.example file into it and configure the database connection.
4. Perform the migrations by running the `php artisan migrate` command.
5. Next, you should execute command the `php artisan passport:install`. This command will create the encryption keys needed to generate secure access tokens.

## Usage

1. Run the application by running the `php artisan serve` command.
2. Open the application in a postman by going to http://localhost:8000.
3. Register or log in to start working with tasks.

## Installation through docker
1. Running the `make up` command.
