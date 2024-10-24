FROM php:8.3-fpm
ARG user
ARG uid
RUN apt update && apt install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zlib1g-dev \
    libzip-dev \
    zip \
    unzip \
    nano \ 
    iputils-ping \
    iproute2 \
    cron \
    nodejs \
    npm

RUN apt clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install zip pdo_mysql mbstring exif pcntl bcmath gd intl
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY docker-compose/php/php.ini /usr/local/etc/php/conf.d/php.ini

# Create the log file to be able to run tail
RUN touch /var/log/cron.log
# Setup cron job
RUN (crontab -l -u $user ; echo "* * * * * cd /var/www && /usr/local/bin/php artisan schedule:run >> /dev/null 2>&1") | crontab

# Run the command on container startup
CMD cron && docker-php-entrypoint php-fpm