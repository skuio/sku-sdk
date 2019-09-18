<?php

namespace Skuio\Sdk\Resource;

use Exception;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class SalesChannels extends Sdk
{
  protected $endpoint = 'sales-channels';

  /**
   * Retrieve sales channels
   *
   * @return Response
   * @throws Exception
   */
  public function get()
  {
    return $this->authorizedRequest( $this->endpoint );
  }
}