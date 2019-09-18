<?php

namespace Skuio\Sdk\Resource;

use Skuio\Sdk\Sdk;

class Warehouses extends Sdk
{
  protected $endpoint = 'warehouses';

  public function get()
  {
    return $this->authorizedRequest( $this->endpoint );
  }
}