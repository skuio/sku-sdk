<?php

namespace Skuio\Sdk\Resource;

use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class SalesChannels extends Sdk
{
  protected $endpoint = 'sales-channels';

  /**
   * Retrieve sales channels
   *
   * @return Response
   */
  public function get()
  {
    return $this->authorizedRequest( $this->endpoint );
  }
}