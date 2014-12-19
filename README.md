Xz ElasticSearch
=============================

Xz ElasticSearch – A [Silex][6] Service Provider based on [Elasticsearch-Php][1]

# Install the library

**dependencies:**

A [Silex][6] Application

## Install with composer

Append following properties to your composer json 

```json
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/xeroxzone/elasticsearch.git"
    },
],
"require": {
    "xeroxzone/elasticsearch": "dev-master"
},
```

## Checkout from Git repository

Clone from [Github][2]

**Run Composer update for your project:**

```bash
$ php composer.phar update xeroxzone/elasticsearch
```

## PHP configuration

PHP Version >= 5.5.x

# Use the library

Usage example under _test/Libraries/ElasticsearchLibraryTest.php

# Copyright

Xz ElasticSearch is a product of [0xz.de][4]
is licensed under the [MIT][license] license.

# License

[Elasticsearch-Php][1] is licensed under the Apache License.

[Silex][6] is licensed under the MIT license.


[1]: http://www.elasticsearch.org/guide/en/elasticsearch/client/php-api
[2]: https://github.com/xeroxzone/elasticsearch
[4]: http://www.0xz.de
[5]: http://symfony.com
[6]: http://silex.sensiolabs.org
[license]: https://github.com/xeroxzone/elasticsearch/blob/master/LICENSE
