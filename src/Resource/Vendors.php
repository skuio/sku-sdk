<?php

namespace Skuio\Sdk\Resource;

use Skuio\Sdk\Sdk;

class Vendors extends Sdk
{
  protected $endpoint = 'vendors';

  public function get()
  {
    return $this->authorizedRequest( $this->endpoint );
  }
}