<?php

namespace Skuio\Sdk\Resource;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\Model\PricingTier;
use Skuio\Sdk\Request;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class VendorPricingTiers extends Sdk
{
  protected $endpoint = 'vendor-pricing-tiers';

  /**
   * Retrieve a list of vendor pricing tiers
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
   * @param PricingTier $pricingTier
   *
   * @return Response
   * @throws Exception
   */
  public function store( PricingTier $pricingTier )
  {
    return $this->authorizedRequest( $this->endpoint, $pricingTier->toJson(), Sdk::METHOD_POST );
  }

  /**
   * @param PricingTier $pricingTier
   *
   * @return Response
   * @throws Exception
   */
  public function update( PricingTier $pricingTier )
  {
    if ( empty( $pricingTier->id ) )
    {
      throw new InvalidArgumentException( 'The id field is required' );
    }

    return $this->authorizedRequest( "{$this->endpoint}/{$pricingTier->id}", $pricingTier->toJson(), Sdk::METHOD_PUT );
  }

  /**
   * @param int $id
   *
   * @return Response
   * @throws Exception
   */
  public function archive( int $id )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$id}/archive", null, self::METHOD_PUT );
  }

  /**
   * @param int $id
   *
   * @return Response
   * @throws Exception
   */
  public function unarchived( int $id )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$id}/unarchived", null, self::METHOD_PUT );
  }

  /**
   * Mark a vendor pricing tier as default tier
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