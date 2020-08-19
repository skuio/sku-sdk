<?php

namespace Skuio\Sdk\Service;

use Exception;
use Skuio\Sdk\DataType\SalesChannel;
use Skuio\Sdk\Query;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class SalesChannels extends Sdk
{
  protected $endpoint = 'sales-channels';

  /**
   * Retrieve sales channels
   *
   * @param Query|null $request
   *
   * @return Response
   * @throws Exception
   */
  public function get(Query $request = null )
  {
    if ( ! $request )
    {
      $request = new Query();
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
    return $this->afterStore(
        $salesChannel,
        $this->authorizedRequest( $this->endpoint, $salesChannel->toJson(), self::METHOD_POST )
    );
  }

}