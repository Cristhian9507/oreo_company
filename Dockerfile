FROM webdevops/php-nginx:8.1
# Install Laravel framework system requirements
RUN set -ex \
  && apt-get update \
  && apt-get install -y --no-install-recommends libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql sockets

# Copy Composer binary from the Composer official Docker image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV WEB_DOCUMENT_ROOT /app/public
WORKDIR /app
COPY . .

RUN composer install --no-interaction --optimize-autoloader
# Optimizing Configuration loading
RUN php artisan config:cache
# Optimizing Route loading
RUN php artisan route:cache
# Optimizing View loading
RUN php artisan view:cache
RUN chown -R application:application .
COPY ./run.sh /tmp
RUN chmod +x /tmp/run.sh
COPY nginx/nginx.conf /etc/nginx/nginx.conf
# ENTRYPOINT ["/tmp/run.sh"]
