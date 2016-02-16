#!/usr/bin/env bash
# -----------------------------------------------------------------------------
#          FILE:  install.sh
#   DESCRIPTION:  Install packages.
# -----------------------------------------------------------------------------

echo "make a choice"
echo "1) install packages"
echo "2) log and cache"
echo "3) add fixtures"
echo "4) run tests"
echo "0) exit"

read command
case $command in
1)
    echo "install"
    npm install
    ./node_modules/.bin/bower install

    curl -sS https://getcomposer.org/installer | php
    php composer.phar install
    rm -rf composer.phar

    ./node_modules/.bin/gulp install
    ./node_modules/gulp/bin/gulp.js
    ./app/console doctrine:database:drop --force
    ./app/console doctrine:database:create
    ./app/console doctrine:schema:update --force
;;

2)
    echo "log and cache"
    rm -rf app/cache/*
    rm -rf app/logs/*

    HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
    sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
    sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
;;

3)
    echo "add fixtures"
    ./app/console doctrine:schema:update --force
    ./app/console h:d:f:l
;;

4)
    echo "run tests"
    ./bin/phpunit -c app
    sleep 5
;;

0)
    exit 0
esac