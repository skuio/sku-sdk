<?php

namespace Skuio\Sdk\Resource;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\Model\ProductPricingTier;
use Skuio\Sdk\Request;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class ProductPricingTiers extends Sdk
{
  protected $endpoint = 'product-pricing-tiers';

  /**
   * Retrieve a list of product pricing tiers
   *
   * @param Request|null $request
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
   * @param ProductPricingTier $productPricingTier
   *
   * @return Response
   * @throws Exception
   */
  public function store( ProductPricingTier $productPricingTier )
  {
    return $this->authorizedRequest( $this->endpoint, $productPricingTier->toJson(), Sdk::METHOD_POST );
  }

  /**
   * Update a product pricing tier
   *
   * @param ProductPricingTier $productPricingTier
   *
   * @return Response
   * @throws Exception
   */
  public function update( ProductPricingTier $productPricingTier )
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
    return $this->authorizedRequest( "{$this->endpoint}/$id/archive" );
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
    return $this->authorizedRequest( "{$this->endpoint}/$id/default" );
  }
}