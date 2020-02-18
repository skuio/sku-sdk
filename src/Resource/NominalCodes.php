<?php

namespace Skuio\Sdk\Resource;

use Exception;
use Skuio\Sdk\Model\NominalCode;
use Skuio\Sdk\Request;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class NominalCodes extends Sdk
{
  protected $endpoint = 'nominal-codes';

  /**
   * Retrieve a list of nominal codes
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
   * View a nominal code
   *
   * @param int $id
   * @param Request|null $request
   *
   * @return Response
   * @throws Exception
   */
  public function show( int $id, Request $request = null )
  {
    if ( ! $request )
    {
      $request = new Request();
    }

    return $this->authorizedRequest( "{$this->endpoint}/{$id}?{$request->getParams()}" );
  }

  /**
   * @param NominalCode $nominalCode
   *
   * @return Response
   * @throws Exception
   */
  public function store( NominalCode $nominalCode )
  {
    return $this->authorizedRequest( $this->endpoint, $nominalCode->toJson(), Sdk::METHOD_POST );
  }

  /**
   * @param NominalCode $nominalCode
   *
   * @return Response
   * @throws Exception
   */
  public function update( NominalCode $nominalCode )
  {
    if ( empty( $nominalCode->id ) )
    {
      throw new \InvalidArgumentException( 'The id field is required.' );
    }

    return $this->authorizedRequest( "{$this->endpoint}/{$nominalCode->id}", $nominalCode->toJson(), Sdk::METHOD_PUT );
  }

  /**
   * @param int $id
   *
   * @return Response
   * @throws Exception
   */
  public function archive( int $id )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$id}/archive", null, self::METHOD_PUT );
  }

  /**
   * @param int $id
   *
   * @return Response
   * @throws Exception
   */
  public function unarchived( int $id )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$id}/unarchived", null, self::METHOD_PUT );
  }
}