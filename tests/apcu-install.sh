#!/bin/bash

APCU=4.0.2

if [ "$TRAVIS_PHP_VERSION" == "5.4" ]
then
    sudo apt-get install autoconf
    wget http://pecl.php.net/get/apcu-$APCU.tgz
    tar zxvf apcu-$APCU.tgz
    cd "apcu-${APCU}"
    phpize && ./configure && make install && echo "Installed ext/apcu-${APCU}"
fi