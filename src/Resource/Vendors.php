<?php

namespace Skuio\Sdk\Resource;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\Model\Vendor;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class Vendors extends Sdk
{
  protected $endpoint = 'vendors';

  /**
   * Retrieve vendors
   *
   * @return Response
   * @throws Exception
   */
  public function get()
  {
    return $this->authorizedRequest( $this->endpoint );
  }

  /**
   * Create a new vendor
   *
   * @param Vendor $vendor
   *
   * @return Response
   * @throws Exception
   */
  public function store( Vendor $vendor )
  {
    return $this->authorizedRequest( $this->endpoint, $vendor->toJson(), Sdk::METHOD_POST );
  }

  /**
   * Update a vendor
   *
   * @param Vendor $vendor
   *
   * @return Response
   * @throws Exception
   */
  public function update( Vendor $vendor )
  {
    if ( empty( $vendor->id ) )
    {
      throw new InvalidArgumentException( 'The "id" field is required' );
    }

    return $this->authorizedRequest( "{$this->endpoint}/$vendor->id", $vendor->toJson(), Sdk::METHOD_PUT );
  }
}