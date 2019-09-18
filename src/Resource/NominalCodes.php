<?php

namespace Skuio\Sdk\Resource;

use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class NominalCodes extends Sdk
{
  protected $endpoint = 'nominal-codes';

  /**
   * Retrieve all nominal codes
   *
   * @return Response
   */
  public function get()
  {
    return $this->authorizedRequest( $this->endpoint );
  }
}