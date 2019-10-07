# AnimeCon REST API
## Installation instructions
Pre requisites:
- PHP 7.3+
- An functional AnPlan database

To get started you will need to clone the API, and copy the `.env` file to a `.env.local` file.

In your `.env.local` file, please edit the `DATABASE_URL` parameter to point to your AnPlan database.

Next, run `composer install` and configure your webserver of choice to point to `public/index.php`.
Ensure that the `APP_ENV` is set to `prod` in the event that you are setting up a production environment, otherwise you might expose your credentials.

**Important!** Do **not** under **any circumstance** run **any** Doctrine command.

## Working with the API
Getting started with the API is easy, simply navigate to the hostname you've configured in your webserver and you will be presented 
with a fully fledged documentation.

Some endpoints and properties may require authentication, documentation for this is pending (and so is the authentication itself.)