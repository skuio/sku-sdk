<?php

namespace Skuio\Sdk\Resource;

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
   */
  public function get( Request $request )
  {
    return $this->authorizedRequest( $this->endpoint . '?' . $request->getParams() );
  }

  /**
   * Show a product brand by id
   *
   * @param int $id
   *
   * @return Response
   */
  public function show( int $id )
  {
    return $this->authorizedRequest( $this->endpoint . '/' . $id );
  }

  /**
   * Create a new product brand
   *
   * @param string $brandName
   *
   * @return Response
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
   */
  public function update( int $id, string $brandName )
  {
    return $this->authorizedRequest( $this->endpoint . '/' . $id, json_encode( [ 'name' => $brandName ] ), self::METHOD_PUT );
  }

  public function delete( int $id )
  {
    return $this->authorizedRequest( $this->endpoint . '/' . $id, null, self::METHOD_DELETE );
  }
}