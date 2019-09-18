<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Resource\Vendors;

class VendorsTest extends TestCase
{
  private $username = '49a683831249ef6a37158f1e1b86e6d5';
  private $password = 'd002707ff6867c1c545adf40ab06bbdf';

  public function testGetVendors()
  {
    $vendors = new Vendors( $this->username, $this->password, true );
    $vendors = $vendors->get();

    $this->assertEquals( 200, $vendors->getCode(), json_encode( $vendors->getResponse() ) );
  }
}