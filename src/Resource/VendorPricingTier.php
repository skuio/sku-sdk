<?php

namespace Skuio\Sdk\Resource;

use Exception;
use Skuio\Sdk\Model\PricingTier;
use Skuio\Sdk\Request;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class VendorPricingTier extends Sdk
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

  public function store( PricingTier $pricingTier )
  {
    return $this->authorizedRequest( $this->endpoint, $pricingTier->toJson(), Sdk::METHOD_POST );
  }
}