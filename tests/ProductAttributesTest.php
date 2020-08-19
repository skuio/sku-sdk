<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\DataType\ProductAttribute;
use Skuio\Sdk\Service\ProductAttributes;
use Skuio\Sdk\Sdk;

class ProductAttributesTest extends TestCase
{
  private $username = '49a683831249ef6a37158f1e1b86e6d5';
  private $password = 'd002707ff6867c1c545adf40ab06bbdf';

  public function testStoreProductAttributes()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $productId = 1;

    $productAttribute        = new ProductAttribute();
    $productAttribute->name  = 'test attribute';
    $productAttribute->type  = 'string';
    $productAttribute->value = 'test value';

    $productAttributes = new ProductAttributes();
    $productAttributes = $productAttributes->store( $productId, [ $productAttribute ] );

    $this->assertEquals( 200, $productAttributes->getStatusCode(), json_encode( $productAttributes->getResponse() ) );
  }

  public function testDeleteProductAttributes()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $productId  = 2;
    $attributes = [ 'test attribute', 'color' ];

    $productAttributes = new ProductAttributes();
    $productAttributes = $productAttributes->delete( $productId, $attributes );

    $this->assertEquals( 200, $productAttributes->getStatusCode(), json_encode( $productAttributes->getResponse() ) );
  }
}