simplecache
===========

A simple cache library for PHP

[![Build Status](https://travis-ci.org/emaphp/simplecache.svg?branch=master)](https://travis-ci.org/emaphp/simplecache)

<br/>
####Changelog

**2014-02-23**

 * Moved to PSR-4.
 * Added class 'TestProvider'. This class stores values in an internal hash for testing purposes.

<br/>
####Description

Simplecache is a small PHP library that provides some useful caching classes compatible with APC and Memcache.

<br/>
####Dependencies

None

<br/>
####Installation

```json
{
    "require": {
        "emaphp/simplecache": "1.1.*"
    }
}
```

<br/>
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

<br/>
**Memcache**

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


<br/>
####License

Licensed under the Apache License, Version 2.0.