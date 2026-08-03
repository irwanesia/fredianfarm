#!/bin/sh

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true

if [ ! -f /var/www/html/vendor/autoload.php ]; then
    echo "Installing composer dependencies..."
    cd /var/www/html
    composer install --no-dev --optimize-autoloader --no-interaction
fi

php artisan key:generate --force 2>/dev/null || true

echo "Creating database if not exists..."
php -r "
\$host = getenv('DB_HOST') ?: 'mysql_core';
\$user = getenv('DB_USERNAME') ?: 'float';
\$pass = getenv('DB_PASSWORD') ?: '333';
\$db   = getenv('DB_DATABASE') ?: 'fredianfarm_db';
try {
    \$pdo = new PDO(\"mysql:host=\$host;port=3306\", \$user, \$pass);
    \$pdo->exec(\"CREATE DATABASE IF NOT EXISTS \$db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci\");
    echo \"Database '\$db' ready.\n\";
} catch (Exception \$e) {
    echo \"DB create skipped: \" . \$e->getMessage() . \"\n\";
}
"

php artisan migrate --force 2>/dev/null || true

php artisan view:clear 2>/dev/null || true

if [ "${APP_ENV}" = "production" ]; then
    php artisan config:cache 2>/dev/null || true
    php artisan route:cache 2>/dev/null || true
fi

apache2-foreground
