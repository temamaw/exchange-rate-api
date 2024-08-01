     Exchange Rate API

This API aggregates and manages exchange rates from various banks, providing a centralized platform for users to compare and trade foreign exchange. By consolidating exchange rates from multiple banks, users can easily view and compare rates, facilitating better financial decisions.

Features:
1.  Centralized Exchange Rates: Aggregates exchange rates from multiple banks into a single platform.
2.  Comparison and Trading: Enables users to compare rates from different banks for buying and selling foreign currencies.
3.  Monetization: Potential to monetize the API by offering premium features or access to a broader range of data.

Prerequisites

    PHP 8.x
    Composer
    MySQL
    AngularJS (for frontend, coming soon)
    Laravel (8.x) (optional)

Installation

    Clone the repository:

git clone https://github.com/temamaw/exchange-rate-api.git

Navigate to the project directory:
 
cd exchange-rate-api

Install PHP dependencies:

composer install

Set up the environment file:

Copy the .env.example file to .env and update the configuration settings as needed.


cp .env.example .env

Generate the application key:


php artisan key:generate

Run migrations to create the database tables:


php artisan migrate

Seed the database with initial data (optional):

  php artisan db:seed

API Endpoints

    Authentication
        POST /register: Register a new user.
        POST /login: Log in and obtain a JWT token.
        GET /me: Retrieve the authenticated user's details.
        POST /logout: Log out and invalidate the JWT token.

    Bank Management
        GET /banks: List all banks.
        POST /banks: Create a new bank.
        GET /banks/{id}: Retrieve a specific bank.
        PUT /banks/{id}: Update a specific bank.
        DELETE /banks/{id}: Delete a specific bank.

    Currency Management
        GET /currencies: List all currencies.
        POST /currencies: Create a new currency.
        GET /currencies/{id}: Retrieve a specific currency.
        PUT /currencies/{id}: Update a specific currency.
        DELETE /currencies/{id}: Delete a specific currency.

    Exchange Rates
        GET /exchange-rates: List all exchange rates.
        POST /exchange-rates: Create a new exchange rate.
        GET /exchange-rates/{id}: Retrieve a specific exchange rate.
        PUT /exchange-rates/{id}: Update a specific exchange rate.
        DELETE /exchange-rates/{id}: Delete a specific exchange rate.

    Rate History
        GET /rate-history: List all rate history records.
        POST /rate-history: Create a new rate history record.
        GET /rate-history/{id}: Retrieve a specific rate history record.
        PUT /rate-history/{id}: Update a specific rate history record.
        DELETE /rate-history/{id}: Delete a specific rate history record.

    User Management
        GET /users: List all users.
        POST /users: Create a new user.
        GET /users/{id}: Retrieve a specific user.
        PUT /users/{id}: Update a specific user.
        DELETE /users/{id}: Delete a specific user.

    Subscription Plans
        GET /subscription-plans: List all subscription plans.
        POST /subscription-plans: Create a new subscription plan.
        GET /subscription-plans/{id}: Retrieve a specific subscription plan.
        PUT /subscription-plans/{id}: Update a specific subscription plan.
        DELETE /subscription-plans/{id}: Delete a specific subscription plan.

    User Subscriptions
        GET /user-subscriptions: List all user subscriptions.
        POST /user-subscriptions: Create a new user subscription.
        GET /user-subscriptions/{id}: Retrieve a specific user subscription.
        PUT /user-subscriptions/{id}: Update a specific user subscription.
        DELETE /user-subscriptions/{id}: Delete a specific user subscription.

Running the Server

To start the Laravel development server, use the following command:


php artisan serve

This will start the server at http://localhost:8000 by default.
Contributing

Contributions are welcome! Please fork the repository and submit a pull request with your proposed changes.
License

This project is licensed under the MIT License.
Author

Temam Awelu Seid