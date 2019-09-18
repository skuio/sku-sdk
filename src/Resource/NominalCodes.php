<?php

namespace Skuio\Sdk\Resource;

use Exception;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class NominalCodes extends Sdk
{
  protected $endpoint = 'nominal-codes';

  /**
   * Retrieve all nominal codes
   *
   * @return Response
   * @throws Exception
   */
  public function get()
  {
    return $this->authorizedRequest( $this->endpoint );
  }
}