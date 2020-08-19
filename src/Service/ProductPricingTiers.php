<?php

namespace Skuio\Sdk\Service;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\DataType\PricingTier;
use Skuio\Sdk\Query;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class ProductPricingTiers extends Sdk
{
  protected $endpoint = 'product-pricing-tiers';

  /**
   * Retrieve a list of product pricing tiers
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

    return $this->authorizedRequest( "{$this->endpoint}?{$request->getParams()}" );
  }

  /**
   * Show a product pricing tier
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
   * Create a new product pricing tier
   *
   * @param PricingTier $productPricingTier
   *
   * @return Response
   * @throws Exception
   */
  public function store( PricingTier $productPricingTier )
  {
    return $this->afterStore(
        $productPricingTier,
        $this->authorizedRequest( $this->endpoint, $productPricingTier->toJson(), Sdk::METHOD_POST )
    );
  }

  /**
   * Update a product pricing tier
   *
   * @param PricingTier $productPricingTier
   *
   * @return Response
   * @throws Exception
   */
  public function update( PricingTier $productPricingTier )
  {
    if ( empty( $productPricingTier->id ) )
    {
      throw new InvalidArgumentException( 'The "id" field is required' );
    }

    return $this->authorizedRequest( "{$this->endpoint}/{$productPricingTier->id}", $productPricingTier->toJson(), Sdk::METHOD_PUT );
  }

  /**
   * Archive a product pricing tier
   *
   * @param int $id
   *
   * @return Response
   * @throws Exception
   */
  public function archive( int $id )
  {
    return $this->authorizedRequest( "{$this->endpoint}/$id/archive", null, self::METHOD_PUT );
  }

  /**
   * Unarchived a product pricing tier
   *
   * @param int $id
   *
   * @return Response
   * @throws Exception
   */
  public function unarchived( int $id )
  {
    return $this->authorizedRequest( "{$this->endpoint}/$id/unarchived", null, self::METHOD_PUT );
  }

  /**
   * Mark a product pricing tier as default tier
   *
   * @param int $id
   *
   * @return Response
   * @throws Exception
   */
  public function setDefault( int $id )
  {
    return $this->authorizedRequest( "{$this->endpoint}/$id/default", null, self::METHOD_PUT );
  }
}