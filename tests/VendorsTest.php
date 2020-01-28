<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Resource\Vendors;
use Skuio\Sdk\Sdk;

class VendorsTest extends TestCase
{
  private $username = '49a683831249ef6a37158f1e1b86e6d5';
  private $password = 'd002707ff6867c1c545adf40ab06bbdf';

  public function testGetVendors()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $vendors = new Vendors();
    $vendors = $vendors->get();

    $this->assertEquals( 200, $vendors->getStatusCode(), json_encode( $vendors->getResponse() ) );
  }
}