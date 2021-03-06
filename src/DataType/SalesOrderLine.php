<?php

namespace Skuio\Sdk\DataType;

use Skuio\Sdk\DataType;

/**
 * Class SalesOrderLine
 *
 * @package Skuio\Sdk\DataType
 *
 * @property int $id
 * @property string $description
 * @property int|null $product_id
 * @property string|null $sku
 * @property float $amount
 * @property float|null $discount
 * @property float $quantity
 * @property float|null $tax
 * @property string|null $sales_channel_line_id
 * @property int|null $nominal_code_id
 * @property string|null $nominal_code_name
 * @property string|null $nominal_code
 * @property bool|null $is_product
 * @property int|null $warehouse_id
 */
class SalesOrderLine extends DataType
{

}