<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Resource\NominalCodes;
use Skuio\Sdk\Sdk;

class NominalCodesTest extends TestCase
{
  private $username = '49a683831249ef6a37158f1e1b86e6d5';
  private $password = 'd002707ff6867c1c545adf40ab06bbdf';

  public function testGetNominalCodes()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $nominalCodes = new NominalCodes();
    $nominalCodes = $nominalCodes->get();

    $this->assertEquals( 200, $nominalCodes->getStatusCode(), json_encode( $nominalCodes->getResponse() ) );
  }
}