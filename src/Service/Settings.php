<?php

namespace Skuio\Sdk\Service;

use Skuio\Sdk\Sdk;
use Skuio\Sdk\Query;
use Skuio\Sdk\Response;
use Exception;
use InvalidArgumentException;

class Settings extends Sdk
{

  protected $endpoint = 'settings';

  /**
   * view all settings
   *
   * @return Response
   * @throws Exception
   */
  public function get()
  {
    return $this->authorizedRequest( $this->endpoint );
  }

  /**
   * show setting by id
   *
   * @param int $id
   *
   * @return Response
   * @throws Exception
   */
  public function show( int $id )
  {
    return $this->authorizedRequest( $this->endpoint . '/' . $id );
  }

  // ToDo validate $id and $value

  /**
   * update setting by id or by code
   *
   * @param $id
   * @param $value
   *
   * @return Response
   * @throws Exception
   *
   *
   */
  public function update( $id, $value )
  {
    return $this->authorizedRequest( $this->endpoint . '/' . $id, json_encode( [ 'value' => $value ] ), self::METHOD_PUT );
  }

}