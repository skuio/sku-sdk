<?php

namespace Skuio\Sdk\Resource;

use Skuio\Sdk\Model\Import;
use Skuio\Sdk\Model\Product;
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
  protected $endpoint = 'products';

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

  /**
   * Retrieve a product by sku
   *
   * @param string $sku
   *
   * @return Response
   */
  public function showBySku( string $sku )
  {
    return $this->authorizedRequest( $this->endpoint . '/by-sku/' . $sku );
  }

  /**
   * Create a new Product
   *
   * @param Product $product
   *
   * @return Response
   */
  public function store( Product $product )
  {
    return $this->authorizedRequest( $this->endpoint, $product->toJson(), self::METHOD_POST );
  }

  /**
   * Update a product
   *
   * @param Product $product
   *
   * @return Response
   */
  public function update( Product $product )
  {
    if ( empty( $product->id ) )
    {
      throw new \InvalidArgumentException( 'The "id" field is required' );
    }

    return $this->authorizedRequest( $this->endpoint . '/' . $product->id, $product->toJson(), self::METHOD_PUT );
  }

  /**
   * Mark a product as archived
   *
   * @param int $id
   *
   * @return Response
   */
  public function archive( int $id )
  {
    return $this->authorizedRequest( $this->endpoint . '/archive/' . $id, null, self::METHOD_PUT );
  }

  /**
   * Delete a product
   *
   * @param int $id
   *
   * @return Response
   */
  public function delete( int $id )
  {
    return $this->authorizedRequest( $this->endpoint . '/' . $id, null, self::METHOD_DELETE );
  }

  /**
   * Import products from a CSV file
   *
   * @param Import $importProducts
   *
   * @return Response
   */
  public function import( Import $importProducts )
  {
    if ( empty( $importProducts->csv_file ) )
    {
      throw new \InvalidArgumentException( 'The csv_file field is required' );
    }

    return $this->authorizedRequest( $this->endpoint . '/import', $importProducts->toArray(), self::METHOD_POST );
  }

  /**
   * Retrieve product constants data
   *
   * @return Response
   */
  public function constants()
  {
    return $this->authorizedRequest( $this->endpoint . '/constants' );
  }
}