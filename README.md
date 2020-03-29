# Backoffice

## Prerequisites
You need to have previously installed:
 - php 7.1 or higher
 - Composer
   - For [Linux or Mac](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos "Download Composer on Linux / Mac")
   - For [Windows](https://getcomposer.org/doc/00-intro.md#installation-windows "Download Composer on Windows")
 - MySQL 5.7 or higher
 - To be able to upload file > 2 MB don't forget to update `post_max_size` and `upload_max_filesize` parameters in your server `php.ini file.

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

## API Endpoints
 
 - `GET /api/videos` returns all videos
 - `GET /api/videos/:id` returns the video with id
 - `GET /api/audios` returns all audios
 - `GET /api/audios/:id` returns the audio with id