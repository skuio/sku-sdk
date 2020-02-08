<?php

namespace Skuio\Sdk\Resource;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\Model\ProductImage;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class ProductImages extends Sdk
{
  protected $endpoint = 'product-images';

  /**
   * Retrieve product images
   *
   * @param int $productId
   *
   * @return Response
   * @throws Exception
   */
  public function get( int $productId )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$productId}" );
  }

  /**
   * Add a new image to product
   *
   * @param int $productId
   * @param ProductImage $productImage
   *
   * @return Response
   * @throws Exception
   */
  public function store( int $productId, ProductImage $productImage )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$productId}", $productImage->toJson(), Sdk::METHOD_POST );
  }

  /**
   * Update product image
   *
   * @param ProductImage $productImage
   *
   * @return Response
   * @throws Exception
   */
  public function update( ProductImage $productImage )
  {
    if ( empty( $productImage->id ) )
    {
      throw new InvalidArgumentException( 'The "id" field is required' );
    }

    return $this->authorizedRequest( "{$this->endpoint}/{$productImage->id}", $productImage->toJson(), Sdk::METHOD_PUT );
  }

  /**
   * Delete product image
   *
   * @param int $productImageId
   *
   * @return Response
   * @throws Exception
   */
  public function delete( int $productImageId )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$productImageId}", null, Sdk::METHOD_DELETE );
  }
}