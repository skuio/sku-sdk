<?php

namespace Skuio\Sdk\DataType;

use Skuio\Sdk\DataType;

/**
 * Class SupplierProduct
 *
 * @package Skuio\Sdk\DataType
 *
 * @property int $id
 * @property int $product_id
 * @property int $supplier_id
 * @property string $supplier_name
 * @property bool|null $is_default
 * @property string|null $supplier_sku
 * @property int|null $leadtime
 * @property float|null $minimum_order_quantity
 * @property SupplierProductPricing[] $pricing
 */
class SupplierProduct extends DataType
{
  /**
   * Add pricing
   *
   * @param SupplierProductPricing $pricing
   *
   * @return $this
   */
  public function addPrice(SupplierProductPricing $pricing )
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
   * @param SupplierProductPricing $pricing
   *
   * @return $this
   */
  public function updatePrice(SupplierProductPricing $pricing )
  {
    return $this->addPrice( $pricing );
  }

  /**
   * Delete pricing
   *
   * @param SupplierProductPricing $pricing
   *
   * @return $this
   */
  public function deletePrice(SupplierProductPricing $pricing )
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