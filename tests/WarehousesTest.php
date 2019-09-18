<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Resource\Warehouses;

class WarehousesTest extends TestCase
{
  private $username = '49a683831249ef6a37158f1e1b86e6d5';
  private $password = 'd002707ff6867c1c545adf40ab06bbdf';

  public function testGetWarehouses()
  {
    $warehouses = new Warehouses( $this->username, $this->password, true );
    $warehouses = $warehouses->get();
    
    $this->assertEquals( 200, $warehouses->getCode(), json_encode( $warehouses->getResponse() ) );
  }
}