<?php

namespace Skuio\Sdk\Service;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\DataType\ProductImage;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class ProductImages extends Sdk
{
  protected $endpoint = 'product-images';

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