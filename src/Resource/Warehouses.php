<?php

namespace Skuio\Sdk\Resource;

use Exception;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class Warehouses extends Sdk
{
  protected $endpoint = 'warehouses';

  /**
   * Retrieve warehouses
   *
   * @return Response
   * @throws Exception
   */
  public function get()
  {
    return $this->authorizedRequest( $this->endpoint );
  }
}