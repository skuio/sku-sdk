<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Resource\SalesChannels;
use Skuio\Sdk\Sdk;

class SalesChannelsTest extends TestCase
{
  private $username = '49a683831249ef6a37158f1e1b86e6d5';
  private $password = 'd002707ff6867c1c545adf40ab06bbdf';

  public function testGetSalesChannels()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $salesChannels = new SalesChannels();
    $salesChannels = $salesChannels->get();

    $this->assertEquals( 200, $salesChannels->getStatusCode(), json_encode( $salesChannels->getResponse() ) );
  }
}