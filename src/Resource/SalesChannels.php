<?php

namespace Skuio\Sdk\Resource;

use Exception;
use Skuio\Sdk\Model\SalesChannel;
use Skuio\Sdk\Request;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class SalesChannels extends Sdk
{
  protected $endpoint = 'sales-channels';

  /**
   * Retrieve sales channels
   *
   * @param Request|null $request
   *
   * @return Response
   * @throws Exception
   */
  public function get( Request $request = null )
  {
    if ( ! $request )
    {
      $request = new Request();
    }

    return $this->authorizedRequest( $this->endpoint . '?' . $request->getParams() );
  }

  /**
   * Create a new sales channel
   *
   * @param SalesChannel $salesChannel
   *
   * @return Response
   * @throws Exception
   */
  public function store( SalesChannel $salesChannel )
  {
    return $this->authorizedRequest( $this->endpoint, $salesChannel->toJson(), self::METHOD_POST );
  }

}