<?php

namespace Skuio\Sdk\Service;

use Exception;
use Skuio\Sdk\Query;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class ProductBrands extends Sdk
{
  protected $endpoint = 'product-brands';

  /**
   * Retrieve product brands according to your request
   *
   * @param Query $request
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
   * Show a product brand by id
   *
   * @param int $id
   * @param Query $request
   *
   * @return Response
   * @throws Exception
   */
  public function show(int $id, Query $request = null )
  {
    if ( ! $request )
    {
      $request = new Query();
    }

    return $this->authorizedRequest( "{$this->endpoint}/{$id}?{$request->getParams()}" );
  }

  /**
   * Create a new product brand
   *
   * @param string $brandName
   *
   * @return Response
   * @throws Exception
   */
  public function store( string $brandName )
  {
    return $this->authorizedRequest( $this->endpoint, json_encode( [ 'name' => $brandName ] ), self::METHOD_POST );
  }

  /**
   * Update a product brand by id
   *
   * @param int $id
   * @param string $brandName - the new brand name
   *
   * @return Response
   * @throws Exception
   */
  public function update( int $id, string $brandName )
  {
    return $this->authorizedRequest( $this->endpoint . '/' . $id, json_encode( [ 'name' => $brandName ] ), self::METHOD_PUT );
  }

  /**
   * Archive a product brand by id
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
   * Unarchived a product brand by id
   *
   * @param int $id
   *
   * @return Response
   * @throws Exception
   *
   */
  public function unarchived( int $id )
  {
    return $this->authorizedRequest("{$this->endpoint}/{$id}/unarchived", null, self::METHOD_PUT);
  }
}