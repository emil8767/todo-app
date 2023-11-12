Start off:
- composer install

  Make a copy of the .env.example file and rename it to .env. Configure the database connection and other settings.

- php artisan migrate
- php artisan serve

Open your web browser and check the address http://127.0.0.1:8000.

Rejoice! Your Laravel TODO List project has successfully started.

API documentation is available using Swagger. After running the project, go to http://127.0.0.1:8000/api/documentation to view and test the API methods.

Notes:
If you have problems installing or running your project, please refer to the official Laravel documentation or the Laravel community.
Before you migrate, make sure your server database is running and configured correctly.
Before you use Passport for your first project, make sure your server supports encryption and has an SSL certificate installed.
Happy coding!
