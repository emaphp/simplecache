simplecache
===========

A simple cache library for PHP

Author: Emmanuel Antico
Last Modification: 2014/10/15
Version: 1.0

[![Build Status](https://travis-ci.org/emaphp/simplecache.svg?branch=master)](https://travis-ci.org/emaphp/simplecache)


####Description

Simplecache is a small PHP library that provides some useful caching classes compatible with APC and Memcache.

####Dependencies

None

####Installation

```json
{
    "require": {
        "emaphp/simplecache": "1.0.*"
    }
}
```

####Usage

```php
include 'vendor/autoload.php';

use SimpleCache\APCProvider;

//create provider
$provider = new APCProvider();

//store value
$provider->store("SimpleCache example", "message", 60);

//obtain value
$message = $provider->fetch('message');

//delete value from cache
$provider->delete('message');

//check for presence
$provider->exists('message'); // returns false
```

#####Memcache

There are 2 classes available for memcache servers: *MemcacheProvider* and *MemcachedProvider*. Both must specify the server location during initialization.

```php
//memcache
use SimpleCache\MemcacheProvider;

$provider = new MemcacheProvider('localhost', 11211);

//memcached
use SimpleCache\MemcachedProvider;

$provider = new MemcachedProvider();
$provider->addServer('localhost', 11211);
```

####License

Licensed under the Apache License, Version 2.0.