#!/bin/bash

# Update package lists
apt-get update

# Install dependencies required for intl extension
apt-get install -y libicu-dev
apt-get install -y inetutils-ping
# Enable the intl extension
docker-php-ext-configure intl
docker-php-ext-install intl
docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql