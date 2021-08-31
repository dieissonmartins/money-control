FROM wyveo/nginx-php-fpm:latest

WORKDIR /usr/share/nginx/

# Change current user to www
USER root

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
    libfreetype6 \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl
    
RUN rm -rf /usr/share/nginx/html

RUN ln -s public html

# Install composer
# RUN sudo apt update

# RUN sudo apt install php-cli unzip

# RUN cd ~

# RUN curl -sS https://getcomposer.org/installer -o composer-setup.php


# execute composer
# RUN composer dumpautoload