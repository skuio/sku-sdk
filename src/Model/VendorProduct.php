<?php

namespace Skuio\Sdk\Model;

use Skuio\Sdk\Model;

/**
 * Class VendorProduct
 *
 * @package Skuio\Sdk\Model
 *
 * @property int $id
 * @property int $product_id
 * @property int $vendor_id
 * @property string $vendor_name
 * @property bool $is_default
 * @property string $supplier_sku
 * @property int $leadtime
 * @property float $minimum_order_quantity
 * @property VendorProductPricing[] $pricing
 */
class VendorProduct extends Model
{
  /**
   * Add pricing
   *
   * @param VendorProductPricing $pricing
   *
   * @return $this
   */
  public function addPrice( VendorProductPricing $pricing )
  {
    if ( ! isset( $this->pricing ) )
    {
      $this->pricing = [];
    }

    $this->pricing[] = $pricing;

    return $this;
  }
}