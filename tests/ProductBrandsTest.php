<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Request;
use Skuio\Sdk\Resource\ProductBrands;
use Skuio\Sdk\Sdk;

class ProductBrandsTest extends TestCase
{
  private $username = '49a683831249ef6a37158f1e1b86e6d5';
  private $password = 'd002707ff6867c1c545adf40ab06bbdf';

  public function testGetProductBrands()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $request = new Request();

    $brands = new ProductBrands();
    $brands = $brands->get( $request );

    $this->assertEquals( 200, $brands->getStatusCode(), json_encode( $brands->getResponse() ) );
  }

  public function testShowProductBrand()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $brandId = 1;
    $brands  = new ProductBrands();
    $brands  = $brands->show( $brandId );

    $this->assertEquals( 200, $brands->getStatusCode(), json_encode( $brands->getResponse() ) );
    $this->assertEquals( $brandId, $brands->getResponse()['id'] );
  }

  public function testStoreProductBrand()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $brandName = 'test product brand';
    $brands    = new ProductBrands();
    $brands    = $brands->store( $brandName );

    $this->assertLessThanOrEqual( 201, $brands->getStatusCode(), json_encode( $brands->getResponse() ) );
  }

  public function testUpdateProductBrand()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $brandId   = 1;
    $brandName = 'my test product brand';

    $brands = new ProductBrands();
    $brands = $brands->update( $brandId, $brandName );

    $this->assertEquals( 200, $brands->getStatusCode(), json_encode( $brands->getResponse() ) );
    $this->assertEquals( $brandId, $brands->getResponse()['id'] );
    $this->assertEquals( $brandName, $brands->getResponse()['name'] );
  }

  public function testDeleteProductBrand()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $brandId = 1;
    $brands  = new ProductBrands();
    $brands  = $brands->delete( $brandId );

    $this->assertEquals( 200, $brands->getStatusCode(), json_encode( $brands->getResponse() ) );
  }
}