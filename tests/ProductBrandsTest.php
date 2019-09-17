<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Request;
use Skuio\Sdk\Resource\ProductBrands;

class ProductBrandsTest extends TestCase
{
  private $username = '49a683831249ef6a37158f1e1b86e6d5';
  private $password = 'd002707ff6867c1c545adf40ab06bbdf';

  public function testGetProductBrands()
  {
    $request = new Request();

    $brands = new ProductBrands( $this->username, $this->password, true );
    $brands = $brands->get( $request );

    $this->assertEquals( 200, $brands->getCode(), json_encode( $brands->getResponse() ) );
  }

  public function testShowProductBrand()
  {
    $brandId = 1;
    $brands  = new ProductBrands( $this->username, $this->password, true );
    $brands  = $brands->show( $brandId );

    $this->assertEquals( 200, $brands->getCode(), json_encode( $brands->getResponse() ) );
    $this->assertEquals( $brandId, $brands->getResponse()['id'] );
  }

  public function testStoreProductBrand()
  {
    $brandName = 'test product brand';
    $brands    = new ProductBrands( $this->username, $this->password, true );
    $brands    = $brands->store( $brandName );

    $this->assertLessThanOrEqual( 201, $brands->getCode(), json_encode( $brands->getResponse() ) );
  }

  public function testUpdateProductBrand()
  {
    $brandId   = 1;
    $brandName = 'my test product brand';

    $brands = new ProductBrands( $this->username, $this->password, true );
    $brands = $brands->update( $brandId, $brandName );

    $this->assertEquals( 200, $brands->getCode(), json_encode( $brands->getResponse() ) );
    $this->assertEquals( $brandId, $brands->getResponse()['id'] );
    $this->assertEquals( $brandName, $brands->getResponse()['name'] );
  }

  public function testDeleteProductBrand()
  {
    $brandId = 1;
    $brands  = new ProductBrands( $this->username, $this->password, true );
    $brands  = $brands->delete( $brandId );

    $this->assertEquals( 200, $brands->getCode(), json_encode( $brands->getResponse() ) );
  }
}