#!/bin/bash

if [ "$TRAVIS_PHP_VERSION" == "5.4" ]
then
    echo "no" | pecl install apcu-beta
fi