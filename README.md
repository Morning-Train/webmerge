WebMerge
===

### Requirements

The PHP library depends on PHP 7.4 or higher.

### Installation

#### Composer

If you're using [Composer](http://getcomposer.org/), you can simply add a dependency `droath/webmerge` to your project's composer.json file.

    {
        "require": {
            "droath/webmerge": "dev-master"
        }
    }

### Usage

#### Configuration
Set the WebMerge API key and secret, which are defined within your [WebMerge Account](https://www.webmerge.me/manage/login).

```php
<?php

$config = new \WebMerge\Config(
    '3K83KMN1AL6M1MXMVVCKR66BP9NA', 'I51BBZ5R'
);
$resource = new \WebMerge\Resource($config, '\WebMerge\Resources\Document');
```

#### Get Document
Retrieve a WebMerge resource document by ID.

```php
<?php
...
$resource = new \WebMerge\Resource($config, '\WebMerge\Resources\Document');

$response = null;
try {
    $response = $resource(123456)->get();
} catch (Exception $e) {
    // error handling
}

$data = $response->extract()->asArray();

var_dump($data);
```

### Sponsored By
![Isovera Logo](https://i.imgur.com/dLlbXwR.png)
