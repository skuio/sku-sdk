<?php

namespace Skuio\Sdk\Model;

use Skuio\Sdk\Model;

/**
 * Class VendorProduct
 *
 * @package Skuio\Sdk\Model
 *
 * @property int $product_id
 * @property int $vendor_id
 * @property bool $is_default
 * @property string $supplier_sku
 * @property int $leadtime
 * @property float $minimum_order_quantity
 * @property VendorProductPricing[] $pricing
 */
class VendorProduct extends Model
{

}