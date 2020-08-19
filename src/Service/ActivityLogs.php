<?php

namespace Skuio\Sdk\Service;

use Exception;
use Skuio\Sdk\Query;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class ActivityLogs extends Sdk
{
  protected $endpoint = 'activity-log';

  /**
   * Retrieve a list of activity logs
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
   * Retrieve an activity log
   *
   * @param string $id
   *
   * @return Response
   * @throws Exception
   */
  public function show( string $id )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$id}" );
  }
}