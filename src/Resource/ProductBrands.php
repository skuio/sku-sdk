<?php

namespace Skuio\Sdk\Resource;

use Exception;
use Skuio\Sdk\Request;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class ProductBrands extends Sdk
{
  protected $endpoint = 'product-brands';

  /**
   * Retrieve product brands according to your request
   *
   * @param Request $request
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
   * Show a product brand by id
   *
   * @param int $id
   * @param Request $request
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
}