#!/bin/sh
set -e
set -x

if [ "$1" = '/usr/sbin/apachectl' ]; then
	composer install --prefer-dist --no-interaction --no-suggest
	composer clear-cache
	composer dump-autoload --classmap-authoritative --optimize
    php bin/console assets:install --no-interaction --symlink --relative
	php bin/console cache:clear --env=dev
	php bin/console cache:clear --env=prod
    php bin/console cache:clear --env=test
    php bin/console --no-interaction doctrine:migrations:migrate --env=prod
	php bin/console cache:warmup --env=prod
    touch /srv/changethegame/var/log/app.log
    chown -R 1000:1000 /srv/changethegame
	find /srv/changethegame -type d -exec chmod -R 770 {} +
	find /srv/changethegame -type f -exec chmod -R 660 {} +
    chmod +x /srv/changethegame/bin/*
    chmod +x /srv/changethegame/docker.sh
fi

exec "$@"
