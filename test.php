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

  $variation      = new Product();
  $variation->sku = '789465432';

  $attribute          = new ProductAttribute();
  $attribute->name    = 'size';
  $attribute->value   = 'S';
  $attribute->variant = true;

  $variation->attributes = [ $attribute ];

  $product->variations = [ $variation ];

  $products = new Products();

  $products = $products->store( $product );

  echo $products->getCode() . '<br>';
  print_r( $products->getResponse() );
}

function importProducts( $username, $password )
{
  $import           = new Import();
  $import->csv_file = './tests/import_products_test2.csv';

  $products = new Products();
  $products = $products->import( $import );

  echo $products->getCode() . '<br>';
  print_r( $products->getResponse() );
}

$username = '49a683831249ef6a37158f1e1b86e6d5';
$password = 'd002707ff6867c1c545adf40ab06bbdf';

Sdk::config( [ 'username' => $username, 'password' => $password, 'environment' => Sdk::DEVELOPMENT ] );

createProduct( $username, $password );
echo '<br>----------------<br>';
importProducts( $username, $password );