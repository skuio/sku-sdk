<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Model\Attribute;
use Skuio\Sdk\Model\AttributeValue;
use Skuio\Sdk\Request;
use Skuio\Sdk\Resource\Attributes;
use Skuio\Sdk\Sdk;

class AttributesTest extends TestCase
{
  private $username = '86be828e14eec146b3bd45ef72ece6c3';
  private $password = '28380a285cb463a3bad45d6f608395b1';

  public function testGetAttributes()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $request = new Request();

    $attributes = new Attributes();
    $attributes = $attributes->get( $request );

    $this->assertEquals( 200, $attributes->getStatusCode(), json_encode( $attributes->getResponse() ) );
  }

  public function testStoreAttribute()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $attribute                = new Attribute();
    $attribute->name          = 'Color3';
    $attribute->type          = 'string';
    $attribute->has_options   = true;
    $attribute->sort_order    = 1;
    $attribute->option_values = [
      new AttributeValue( [ 'value' => 'Yalow' ] ),
      new AttributeValue( [ 'value' => 'Red' ] ),
    ];

    $attributes = new Attributes();
    $attributes = $attributes->store( $attribute );

    $this->assertLessThanOrEqual( 201, $attributes->getStatusCode(), json_encode( $attributes->getResponse() ) );
  }

  public function testUpdateAttribute()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $attribute                = new Attribute();
    $attribute->id            = 6;
    $attribute->name          = 'Color';
    $attribute->type          = 'string';
    $attribute->has_options   = true;
    $attribute->sort_order    = 1;
    $attribute->option_values = [
      new AttributeValue( [ 'value' => 'Yalow' ] ),
      new AttributeValue( [ 'value' => 'Red' ] ),
    ];

    $response = ( new Attributes() )->update( $attribute );

    $this->assertEquals( 200, $response->getStatusCode(), json_encode( $response->getResponse() ) );
  }

  public function testArchiveAttribute()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $attributeId = 1;
    $response    = ( new Attributes() )->archive( $attributeId );

    $this->assertEquals( 200, $response->getStatusCode(), json_encode( $response->getResponse() ) );
  }

  public function testUnarchivedAttribute()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $attributeId = 1;
    $response    = ( new Attributes() )->unarchived( $attributeId );

    $this->assertEquals( 200, $response->getStatusCode(), json_encode( $response->getResponse() ) );
  }

  public function testDeleteAttribute()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $attributeId = 1;
    $attributes  = new Attributes();
    $attributes  = $attributes->delete( $attributeId );

    $this->assertEquals( 200, $attributes->getStatusCode(), json_encode( $attributes->getResponse() ) );
  }
}