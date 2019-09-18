<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Resource\SalesChannels;

class SalesChannelsTest extends TestCase
{
  private $username = '49a683831249ef6a37158f1e1b86e6d5';
  private $password = 'd002707ff6867c1c545adf40ab06bbdf';

  public function testGetSalesChannels()
  {
    $salesChannels = new SalesChannels( $this->username, $this->password, true );
    $salesChannels = $salesChannels->get();

    $this->assertEquals( 200, $salesChannels->getCode(), json_encode( $salesChannels->getResponse() ) );
  }
}