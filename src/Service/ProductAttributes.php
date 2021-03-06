<?php

namespace Skuio\Sdk\Service;

use Exception;
use Skuio\Sdk\DataType\ProductAttribute;
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
   * @throws Exception
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
   * get product attributes grouped by id
   *
   * @param int $productId
   *
   * @return Response
   * @throws Exception
   *
   */
  public function getAttributesGrouped( int $productId )
  {
    return $this->authorizedRequest("products/${productId}/attributes-grouped");
  }
}