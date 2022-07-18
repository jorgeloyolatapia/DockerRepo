# PHP - NGINX - MARIADB DEBUG ENVIROMENT

This environment was made only used for developing solutions.
## Description: 
This environment use:
- php:8.1.6RC1-fpm-alpine3.15
- nginx:1.21.6
- mariadb:10.7.4
- xdebug 3 (important, with xdebug 2 dont work)

## Instructions: 
1. Move the .vscode directory to the root path in Visual Code

1. Start the docker-compose services in the background (detached):
  ```
    $ docker-compose up -d
  ```