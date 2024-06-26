# Docker-Compose-PHP-MySQL

This is a full-stack Php web app with MySql and phpMySql using Docker

docker-php-ext-install mysqli
To run this code, run command: docker-compose up from the shell within the directory of this project after cloning it.

To run this code, stop all command:docker-compose down

Errors
Fatal error: Uncaught Error: Call to undefined function mysqli_connect() in /var/www/html/index.php:3 Stack trace: #0 {main} thrown in /var/www/html/index.php on line 3

Solution
Open the interactive terminal with your docker container that's running the www service and run the command: docker-php-ext-install mysqli && docker-php-ext-enable mysqli && apachectl restart

URL
phpMyAdmin : http://localhost:8001

Test
http://localhost/public/index.php
http://localhost/src/views/index.php
