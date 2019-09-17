<?php

namespace Skuio\Sdk\Resource;

use Skuio\Sdk\Model\ProductAttribute;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class ProductAttributes extends Sdk
{
  protected $endpoint = 'product-attributes';

  /**
   * Update or set new attributes to a product
   *
   * @param int $productId
   * @param ProductAttribute[] $attributes
   *
   * @return Response
   */
  public function store( int $productId, array $attributes )
  {
    $body = [ 'attributes' => [] ];
    foreach ( $attributes as $attribute )
    {
      if ( $attribute instanceof ProductAttribute )
      {
        $body['attributes'][] = $attribute->toArray();
      } else if ( is_array( $attribute ) )
      {
        $body['attributes'][] = $attribute;
      }
    }

    return $this->authorizedRequest( $this->endpoint . '/' . $productId, json_encode( $body ), self::METHOD_PUT );
  }

  /**
   * Unset attributes to a product
   *
   * @param int $productId
   * @param string[] $attributes
   *
   * @return Response
   */
  public function delete( int $productId, array $attributes )
  {
    return $this->authorizedRequest( $this->endpoint . '/' . $productId, json_encode( [ 'attributes' => $attributes ] ), self::METHOD_DELETE );
  }
}