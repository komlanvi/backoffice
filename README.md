# Backoffice

## Prerequisites
You need to have previously installed:
 - php 7.1 or higher
 - Composer
   - For [Linux or Mac]("https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos")
   - For [Windows]("https://getcomposer.org/doc/00-intro.md#installation-windows")
 - MySQL 5.7 or higher

## Install dependencies
`composer install`

## Create database
`php bin/console doctrine:database:create`

## Run migrations
`php bin/console doctrine:migrations:migrate`

## Run fixtures to have some data to test
`php bin/console doctrine:fixtures:load`

## Start the server
`symfony server:start`