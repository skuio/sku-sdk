<?php

namespace Skuio\Sdk\Service;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\DataType\Incoterm;
use Skuio\Sdk\Query;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class Incoterms extends Sdk
{
  protected $endpoint = 'incoterms';

  /**
   * Retrieve a list of incoterms
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
   * View an incoterm
   *
   * @param int $id
   *
   * @return Response
   * @throws Exception
   */
  public function show( int $id )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$id}" );
  }

  /**
   * Create a new incoterm
   *
   * @param Incoterm $incoterm
   *
   * @return Response
   * @throws Exception
   */
  public function store( Incoterm $incoterm )
  {
    return $this->afterStore(
        $incoterm,
        $this->authorizedRequest( $this->endpoint, $incoterm->toJson(), self::METHOD_POST )
    );
  }

  /**
   * Update an incoterm
   *
   * @param Incoterm $incoterm
   *
   * @return Response
   * @throws Exception
   */
  public function update( Incoterm $incoterm )
  {
    if ( empty( $incoterm->id ) )
    {
      throw new InvalidArgumentException( 'The id field is required' );
    }

    return $this->authorizedRequest( "{$this->endpoint}/{$incoterm->id}", $incoterm->toJson(), self::METHOD_PUT );
  }

  /**
   * Archive an incoterm
   *
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
   * Unarchived an incoterm
   *
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