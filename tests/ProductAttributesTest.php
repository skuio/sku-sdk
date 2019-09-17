<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Model\ProductAttribute;
use Skuio\Sdk\Resource\ProductAttributes;

class ProductAttributesTest extends TestCase
{
  private $username = '49a683831249ef6a37158f1e1b86e6d5';
  private $password = 'd002707ff6867c1c545adf40ab06bbdf';

  public function testStoreProductAttributes()
  {
    $productId = 1;

    $productAttribute        = new ProductAttribute();
    $productAttribute->name  = 'test attribute';
    $productAttribute->type  = 'string';
    $productAttribute->value = 'test value';

    $productAttributes = new ProductAttributes( $this->username, $this->password, true );
    $productAttributes = $productAttributes->store( $productId, [ $productAttribute ] );

    $this->assertEquals( 200, $productAttributes->getCode(), json_encode( $productAttributes->getResponse() ) );
  }

  public function testDeleteProductAttributes()
  {
    $productId  = 2;
    $attributes = [ 'test attribute', 'color' ];

    $productAttributes = new ProductAttributes( $this->username, $this->password, true );
    $productAttributes = $productAttributes->delete( $productId, $attributes );

    $this->assertEquals( 200, $productAttributes->getCode(), json_encode( $productAttributes->getResponse() ) );
  }
}