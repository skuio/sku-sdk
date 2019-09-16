<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Model\Attribute;
use Skuio\Sdk\Model\ImportProducts;
use Skuio\Sdk\Model\Product;
use Skuio\Sdk\Model\Variation;
use Skuio\Sdk\Request;
use Skuio\Sdk\Resource\Products;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class ProductsTest extends TestCase
{
  private $username = '49a683831249ef6a37158f1e1b86e6d5';
  private $password = 'd002707ff6867c1c545adf40ab06bbdf';

  public function testConnection()
  {
    $sdk = new Sdk( $this->username, $this->password, true );
    $res = $sdk->authorizedRequest( '/products', [] );

    $this->assertInstanceOf( Response::class, $res );

    $this->assertEquals( 200, $res->getCode() );
  }

  public function testGetProducts()
  {
    $productsRequest = new Request();
    $productsRequest->setConjunction( 'and' );
    $productsRequest->addFilter( 'sku', '=', '5333180491623' );

    $products = new Products( $this->username, $this->password, true );
    $products = $products->get( $productsRequest );

    $this->assertEquals( 200, $products->getCode() );
  }

  public function testShowProductById()
  {
    $productId = 1;
    $products  = new Products( $this->username, $this->password, true );
    $products  = $products->showById( $productId );

    $this->assertEquals( 200, $products->getCode() );

    $this->assertEquals( $products->getResponse()['data']['id'], $productId );
    echo "\n" . $products->getResponse()['data']['name'] . "\n";
  }

  public function testShowProductBySku()
  {
    $productSku = '5333180491623';
    $products   = new Products( $this->username, $this->password, true );
    $products   = $products->showBySku( $productSku );

    $this->assertEquals( 200, $products->getCode() );

    $this->assertEquals( $products->getResponse()['data']['sku'], $productSku );

    echo "\n" . $products->getResponse()['data']['name'] . "\n";
  }

  public function testStoreProduct()
  {
    $product                 = new Product();
    $product->sku            = '123456789';
    $product->name           = 'my first test';
    $product->brand_name     = 'test brand';
    $product->type           = 'standard';
    $product->weight         = 15.2;
    $product->weight_unit    = 'kg';
    $product->height         = 5.4;
    $product->width          = 3.4;
    $product->length         = 2.4;
    $product->dimension_unit = 'cm';

    $variation      = new Variation();
    $variation->sku = '7894654';

    $attribute          = new Attribute();
    $attribute->name    = 'size';
    $attribute->value   = 'S';
    $attribute->variant = true;

    $variation->attributes = [ $attribute ];

    $product->variations = [ $variation ];

    $products = new Products( $this->username, $this->password, true );

    $products = $products->store( $product );

    $this->assertEquals( 201, $products->getCode(), json_encode( $products->getResponse() ) );
  }

  public function testUpdateProduct()
  {
    $product         = new Product();
    $product->id     = 2;
    $product->weight = 20.5;

    $products = new Products( $this->username, $this->password, true );

    $products = $products->update( $product );

    $this->assertEquals( 200, $products->getCode(), json_encode( $products->getResponse() ) );
  }

  public function testArchiveProduct()
  {
    $productId = 1;
    $products  = new Products( $this->username, $this->password, true );
    $products  = $products->archive( $productId );

    $this->assertEquals( 200, $products->getCode(), json_encode( $products->getResponse() ) );
  }

  public function testDeleteProduct()
  {
    $productId = 1;
    $products  = new Products( $this->username, $this->password, true );
    $products  = $products->delete( $productId );

    $this->assertEquals( 200, $products->getCode(), json_encode( $products->getResponse() ) );
  }

  public function testImportProducts()
  {
    $import           = new ImportProducts();
    $import->csv_file = './tests/import_products_test2.csv';

    $products = new Products( $this->username, $this->password, true );
    $products = $products->import( $import );

    print_r( $products->getResponse() );

    $this->assertEquals( 200, $products->getCode(), json_encode( $products->getResponse() ) );
  }
}