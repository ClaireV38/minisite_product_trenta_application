# minisite_products_trenta_application

# ![Logo Site](assets/images/faviconReadme.png) Street Style

"Street Style" is a symfony small project that displays a list of products on the home page

simple user has possibility to :
- see all products displayed on small cards on the homepage
- filter products by category
- see users' comments at the bottom of the page
- click on each card to see product details 

admin has the possibility to :
- login by entring /admin after the url of the site into his web browser's address bar
- when connected, see a list of all products
- add, edit and delete products (with photo upload)
- logout

## Installation

### Prerequisites

1. Check composer is installed
2. Check yarn & node are installed

### Install

1. Clone this project
2. Create .env.local and set `DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=8` <br> and 
3. Run `composer install`
4. Run `yarn install`
5. Run `yarn encore dev` to build assets
6. Run `php bin/console d:d:c`
7. Run `php bin/console d:m:m`
8. Run `php bin/console doctrine:fixtures:load`
9. Run `symfony server:start`

### Working

1. Run `yarn run dev --watch` to launch your local server for assets
