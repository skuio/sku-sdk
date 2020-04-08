<?php

namespace Skuio\Sdk\Resource;

use Exception;
use Skuio\Sdk\Model\SalesChannel;
use Skuio\Sdk\Model\SalesOrder;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;
use InvalidArgumentException;

class SalesChannels extends Sdk
{
  protected $endpoint                = 'sales-channels';

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