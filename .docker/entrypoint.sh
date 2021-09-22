#!/bin/bash
echo "Local Only: Composer install..."
/usr/bin/composer install --no-interaction --no-plugins --prefer-dist && chown -R devuser:devuser /var/www/vendor

##Run App
"$@"
