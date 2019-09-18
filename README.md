SKU.io SDK
============

A PHP package to connect to sku.io User API.

Table of contents
-----------------
* [Installation](#installation)
* [Usage](#usage)
* [Example Usage](#test-usage)

Installation
------------

Installation using composer:

```
composer require skuio/sku-sdk
```

Usage
------------

- You need to create or get user API credentials from this APIs
[User API](https://sku-team.postman.co/collections/7106214-dd7d8359-9d9d-480b-99c0-701c1c84f8d2?version=latest&workspace=c8bc7981-b4f6-4259-8060-e9b7b013382d#2b98e627-d202-4c61-b4ae-82d68241c82f)

    This APIs return
    ```json
    {
      "key": "f6a9f775f414ecc550a....",
      "secret": "0a9be418866a453cb9...."
    }
    ```
- Use this credentials to connect with sku.io user api (`username`, `password`).
- Set the SDK configurations:
    - username
    - password
    - environment
    > you can set `url` or `dev_url` if you want to change your testing domains.
- the SDK handle response automatically and you code get the results using these three functions:
    - `getCode()`: returns http response status of  i.e (200,500 ..).
    - `getResponse()`: returns the JSON format response (response also return errors like validation errors ..etc).
    - `getCurlError()`: returns the `curl` error. 

Example Usage
------------

Here is an example of a function used to get products from sku.io:

```php
use Skuio\Sdk\Sdk;
use Skuio\Sdk\Request;
use Skuio\Sdk\Resource\Products;

public function getProducts()
{
    Sdk::config( [ 'username' => $username, 'password' => $password, 'environment' => Sdk::DEVELOPMENT ] );

    $productsRequest = new Request();
    $productsRequest->setConjunction( 'and' );
    $productsRequest->addFilter( 'sku', '=', '5333180491623' );
    $productsRequest->setLimit( 15 );
    $productsRequest->setPage( 1 );
    
    $products = new Products();
    $products = $products->get( $productsRequest );
    
    return $products->getResponse();
}
```

And you can use the base `Sdk` class

```php
use Skuio\Sdk\Sdk;

public function testConnection()
{
    Sdk::config( [ 'username' => $username, 'password' => $password, 'environment' => Sdk::DEVELOPMENT ] );

    $sdk = new Sdk();
    $res = $sdk->authorizedRequest( '/vendors' );
    
    return $res->getResponse();
}
```