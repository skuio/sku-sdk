<?php

namespace Skuio\Sdk\DataType;

use Skuio\Sdk\DataType;

/**
 * Class InventoryAdjustment
 *
 * @package Skuio\Sdk\DataType
 *
 * @property int $id
 * @property string $adjustment_date
 * @property int $product_id
 * @property int $warehouse_id
 * @property int $warehouse_location_id
 * @property float $quantity
 * @property string $notes
 */
class InventoryAdjustment extends DataType
{
}