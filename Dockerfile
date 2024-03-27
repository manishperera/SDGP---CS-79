# Use a PHP base image
FROM php:latest

# Copy project files
COPY . .

# Install Composer
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    curl \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/* \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create .env file
RUN echo 'APP_ENV=local\nDB_HOST=ep-plain-dust-a2execv7.eu-central-1.pg.koyeb.app\nDB_PORT=5432\nDB_USER=koyeb-adm\nDB_PASSWORD=WTPl9gUrLtx5\nDB_NAME=koyebdb\nDB_CHARSET=utf8mb4\nDB_COLLATION=utf8mb4_general_ci' > .env

RUN composer install

# Run migration command
RUN php vendor/lulco/phoenix/bin/phoenix migrate --config=app/configs/phoenix.php
