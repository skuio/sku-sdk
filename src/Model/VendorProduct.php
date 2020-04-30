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
 * @property bool|null $is_default
 * @property string|null $supplier_sku
 * @property int|null $leadtime
 * @property float|null $minimum_order_quantity
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
    $pricing->operation = 'updateOrCreate';

    $this->pricing[] = $pricing;

    return $this;
  }

  /**
   * Add pricing
   *
   * @param VendorProductPricing $pricing
   *
   * @return $this
   */
  public function updatePrice( VendorProductPricing $pricing )
  {
    return $this->addPrice( $pricing );
  }

  /**
   * Delete pricing
   *
   * @param VendorProductPricing $pricing
   *
   * @return $this
   */
  public function deletePrice( VendorProductPricing $pricing )
  {
    if ( ! isset( $this->pricing ) )
    {
      $this->pricing = [];
    }
    $pricing->operation = 'delete';

    $this->pricing[] = $pricing;

    return $this;
  }
}