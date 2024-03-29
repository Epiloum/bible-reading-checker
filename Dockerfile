FROM php:8.0-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Set user root
USER root

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql mbstring exif pcntl bcmath gd
RUN zend_extension=xdebug.so

# Install Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
WORKDIR /usr/local/etc/php/conf.d/
RUN touch local.ini \
    && echo "xdebug.remote_host=host.docker.internal" >> local.ini \
    && echo "xdebug.remote_connect_back=1" >> local.ini \
    && echo "xdebug.remote_port=9000" >> local.ini \
    && echo "xdebug.idekey=PHPSTORM" >> local.ini \
    && echo "xdebug.cli_color=1" >> local.ini \
    && echo "xdebug.remote_handler=dbgp" >> local.ini \
    && echo "xdebug.remote_mode=req" >> local.ini

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user
