<?php

namespace Skuio\Sdk\Resource;

use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class SalesOrderLines extends Sdk
{
  protected $endpoint = 'sales-order-lines';

  /**
   * Delete a sales order line by id
   *
   * @param int $id
   *
   * @return Response
   */
  public function delete( int $id )
  {
    return $this->authorizedRequest( $this->endpoint . '/' . $id, null, self::METHOD_DELETE );
  }
}