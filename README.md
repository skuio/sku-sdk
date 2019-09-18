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
- Use this credentials to connect with sku.io user api by this library (`username`, `password`)
- Resources need `username`, `password` and optional parameter to use the development domain or not
- All functions return a `Response` instance that have three functions:
    - `getCode()`: returns http code of response.
    - `getResponse()`: returns the response.
    - `getCurlError()`: returns the `curl` error only. 

Example Usage
------------

Here is an example of a function used to get products from sku.io:

```php
public function getProducts()
{
    $productsRequest = new Request();
    $productsRequest->setConjunction( 'and' );
    $productsRequest->addFilter( 'sku', '=', '5333180491623' );
    $productsRequest->setLimit( 15 );
    $productsRequest->setPage( 1 );
    
    $products = new Products( $username, $password, true );
    $products = $products->get( $productsRequest );
    
    return $products->getResponse();
}
```

And you can use the base `Sdk` class

```php
public function testConnection()
{
    $sdk = new Sdk( $username, $password, true );
    $res = $sdk->authorizedRequest( '/vendors' );
    
    return $res->getResponse();
}
```