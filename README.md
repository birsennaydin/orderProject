
## About Project

The following features are provided by this project:

-User verification,
- Product listing,
- Product creation,
- Order listing,
- Creating an order,
- Deleting an order,
- Discount calculation

## What to do;
- Clone the repo
- Install the dependencies with composer install
- Copy .env.example to .env
- Create a database
- Run php artisan key:generate
- Run php artisan migrate
- Run 'docker-compose up' in the project,
- Examine the document under 'app/Http/Documents' or 'https://documenter.getpostman.com/view/23414505/2s7Z7WqvHJ' the document at this address,
- Create a user with 'php artisan tinker' from within the project,
- Get Bearer token using this user's 'email' and 'password' and login endpoint,
- Upgrade the service with 'php artisan serve',
- Now you can request any endpoint using Bearer token.

## Technologies
- Php 7.3.29
- Laravel 8.83.23
- Mysql 8.0.30
- Cache -> Laravel Cache Mechanism (using Redis, used in product listing)
- Postman Documentaion
- Docker -> Laravel Docker Mechanism

### Details

- Api System
- Payload Validation (app/Http/Requests Rules are written under app/Request)
- Model
- Service (app/Http/Services)
- Interface (app/Http/Interfaces)
- Repository (app/Http/Repositories)
- Trait (for Cache System)
- Response (written but not used, code will be edited)

###What needs improvement

- Logging should be added
- Modeling should be used for response
