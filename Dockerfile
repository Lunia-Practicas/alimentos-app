# Utilizar una imagen base de PHP 8.2 con Fpm
FROM php:8.2-fpm
WORKDIR /var/www/html

# Instalar las dependencias necesarias
RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    nginx \
        && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip

# Instalar extensiones de PHP necesarias
#RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
#    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Copiar los archivos de la aplicación al contenedor
COPY . /var/www/html

# Dar permisos al almacenamiento y a todos los archivos
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Exponer el puerto 80 para el servidor web
EXPOSE 80

# Ejecutar Composer install para instalar las dependencias del proyecto
#RUN composer install --ignore-platform-req=ext-curl --ignore-platform-req=ext-gd --ignore-platform-req=ext-http --ignore-platform-req=ext-zip
RUN composer install --no-scripts --no-autoloader --ignore-platform-req=ext-curl --ignore-platform-req=ext-gd --ignore-platform-req=ext-http --ignore-platform-req=ext-zip

## Configurar el entrypoint
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
