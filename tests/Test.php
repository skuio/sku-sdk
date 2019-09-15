<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Resources\Products;
use Skuio\Sdk\Request;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class Test extends TestCase
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

    echo '<br>';
    print_r( $products->getResponse() );
  }

  public function testShowProduct()
  {
    $products = new Products( $this->username, $this->password, true );
    $products = $products->showById( 1 );

    $this->assertEquals( 200, $products->getCode() );

    echo '<br>';
    print_r( $products->getResponse() );
  }
}