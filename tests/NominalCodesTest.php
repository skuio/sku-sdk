<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Resource\NominalCodes;

class NominalCodesTest extends TestCase
{
  private $username = '49a683831249ef6a37158f1e1b86e6d5';
  private $password = 'd002707ff6867c1c545adf40ab06bbdf';

  public function testGetNominalCodes()
  {
    $nominalCodes = new NominalCodes( $this->username, $this->password, true );
    $nominalCodes = $nominalCodes->get();

    $this->assertEquals( 200, $nominalCodes->getCode(), json_encode( $nominalCodes->getResponse() ) );
  }
}