<?php

namespace Skuio\Sdk\Resource;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\Model\Vendor;
use Skuio\Sdk\Model\VendorProduct;
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

  /**
   * View a list of vendor products
   *
   * @param int $id vendor id
   *
   * @return Response
   * @throws Exception
   */
  public function products( int $id )
  {
    return $this->authorizedRequest( "vendor-products/{$id}" );
  }

  /**
   * Create a new vendor product
   *
   * @param VendorProduct $vendorProduct
   *
   * @return Response
   * @throws Exception
   */
  public function storeVendorProduct( VendorProduct $vendorProduct )
  {
    return $this->authorizedRequest( "vendor-products", $vendorProduct->toJson(), Sdk::METHOD_POST );
  }

//  public function updateVendorProduct( VendorProduct $vendorProduct )
//  {
//    if ( empty( $vendorProduct->id ) )
//    {
//      throw new InvalidArgumentException( 'The "id" field is required' );
//    }
//  }
}