<?php

namespace Skuio\Sdk\Resources;

use Skuio\Sdk\Request;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

/**
 * Class Products
 *
 * @package Skuio\Sdk\Products
 *
 * It will serve the "products" resource
 */
class Products extends Sdk
{
  private $endpoint = 'products';

  /**
   * Retrieve products according to your request
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
   * Retrieve a product by id
   *
   * @param int $id
   *
   * @return Response
   */
  public function showById( int $id )
  {
    return $this->authorizedRequest( $this->endpoint . '/' . $id );
  }
}