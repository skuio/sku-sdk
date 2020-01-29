<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Request;
use Skuio\Sdk\Resource\ProductBrands;
use Skuio\Sdk\Sdk;

class ProductBrandsTest extends TestCase
{
  private $username = '86be828e14eec146b3bd45ef72ece6c3';
  private $password = '28380a285cb463a3bad45d6f608395b1';

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
    $this->assertEquals( $brandId, $brands->getData()['id'] );
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
    $this->assertEquals( $brandId, $brands->getData()['id'] );
    $this->assertEquals( $brandName, $brands->getData()['name'] );
  }

  public function testArchiveProductBrand()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $brandId = 1;
    $brands  = new ProductBrands();
    $brands  = $brands->archive( $brandId );

    // for warning
    $this->assertLessThan( 300, $brands->getStatusCode(), json_encode( $brands->getResponse() ) );
  }
}