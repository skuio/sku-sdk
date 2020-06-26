<?php

namespace Skuio\Sdk\Model;

use Skuio\Sdk\Model;

/**
 * Class SalesOrderLine
 *
 * @package Skuio\Sdk\Model
 *
 * @property int $id
 * @property string|null $sales_channel_line_id
 * @property int|null $product_id
 * @property string|null $sku
 * @property string $description
 * @property float $amount
 * @property float $quantity
 * @property float|null $discount
 * @property float|null $tax
 * @property int|null $nominal_code_id
 * @property string|null $nominal_code_name
 * @property string|null $nominal_code
 * @property bool|null $is_product
 * @property int $warehouse_id
 */
class SalesOrderLine extends Model
{

}