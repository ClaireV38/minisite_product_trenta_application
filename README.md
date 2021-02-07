# minisite_products_trenta_application

Getting Started
Prerequisites
Check composer is installed
Check yarn & node are installed
Install
Clone this project
Create an .env.local file
In the newly created .env.local file, define the following variables:
DATABASE_URL
MAILER_DSN
Run composer install
Run php bin/console d:d:c to create the database
Run php bin/console d:m:m to make the migration
Run php bin/console d:f:l to load the fixtures
Run yarn install
Run yarn encore dev to build assets
Working
Run symfony server:start to launch your local php web server
Run yarn run dev --watch to launch your local server for assets
