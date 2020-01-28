<?php

include 'vendor/autoload.php';

use Skuio\Sdk\Model\Import;
use Skuio\Sdk\Model\Product;
use Skuio\Sdk\Model\ProductAttribute;
use Skuio\Sdk\Resource\Products;
use Skuio\Sdk\Sdk;

function createProduct( $username, $password )
{
  $product                 = new Product();
  $product->sku            = '12345678911';
  $product->name           = 'my first test';
  $product->brand_name     = 'test brand';
  $product->type           = 'standard';
  $product->weight         = 15.2;
  $product->image          = 'http://ecx.images-amazon.com/images/I/41HpVbFiyRL.jpg';
  $product->weight_unit    = 'kg';
  $product->height         = 5.4;
  $product->width          = 3.4;
  $product->length         = 2.4;
  $product->dimension_unit = 'cm';

  $products = new Products();

  $products = $products->store( $product );

  echo $products->getStatusCode() . '<br>';
  print_r( $products->getResponse() );
}

function importProducts( $username, $password )
{
  $import           = new Import();
  $import->csv_file = './tests/import_products_test2.csv';

  $products = new Products();
  $products = $products->import( $import );

  echo $products->getStatusCode() . '<br>';
  print_r( $products->getResponse() );
}

$username = '86be828e14eec146b3bd45ef72ece6c3';
$password = '28380a285cb463a3bad45d6f608395b1';

Sdk::config( [ 'username' => $username, 'password' => $password, 'environment' => Sdk::DEVELOPMENT ] );

print_r(is_null(json_decode(null, true)));

exit;
createProduct( $username, $password );
echo '<br>----------------<br>';
importProducts( $username, $password );