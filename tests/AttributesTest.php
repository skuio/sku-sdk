<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Model\Attribute;
use Skuio\Sdk\Request;
use Skuio\Sdk\Resource\Attributes;

class AttributesTest extends TestCase
{
  private $username = '49a683831249ef6a37158f1e1b86e6d5';
  private $password = 'd002707ff6867c1c545adf40ab06bbdf';

  public function testGetAttributes()
  {
    $request = new Request();

    $attributes = new Attributes( $this->username, $this->password, true );
    $attributes = $attributes->get( $request );

    $this->assertEquals( 200, $attributes->getCode(), json_encode( $attributes->getResponse() ) );
  }

  public function testStoreAttribute()
  {
    $attribute                   = new Attribute();
    $attribute->name             = 'Color';
    $attribute->type             = 'string';
    $attribute->has_options      = true;
    $attribute->update_if_exists = true;
    $attribute->values           = [ 'Yallow', 'Red' ];

    $attributes = new Attributes( $this->username, $this->password, true );
    $attributes = $attributes->store( $attribute );

    $this->assertLessThanOrEqual( 201, $attributes->getCode(), json_encode( $attributes->getResponse() ) );
  }

  public function testDeleteAttribute()
  {
    $attributeId = 1;
    $attributes  = new Attributes( $this->username, $this->password, true );
    $attributes  = $attributes->delete( $attributeId );

    $this->assertEquals( 200, $attributes->getCode(), json_encode( $attributes->getResponse() ) );
  }
}