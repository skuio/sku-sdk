<?php

namespace Skuio\Sdk\Resource;

use Exception;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class Vendors extends Sdk
{
  protected $endpoint = 'vendors';

  /**
   * Retrieve vendors
   *
   * @return Response
   * @throws Exception
   */
  public function get()
  {
    return $this->authorizedRequest( $this->endpoint );
  }
}