<?php

namespace Skuio\Sdk\Resource;

use Exception;
use Skuio\Sdk\Request;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class ActivityLogs extends Sdk
{
  protected $endpoint = 'activity-log';

  /**
   * Retrieve a list of activity logs
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