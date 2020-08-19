<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 7/24/20
 * Time: 9:02 AM
 */

namespace Skuio\Sdk\DataType;


use Carbon\Carbon;
use Skuio\Sdk\DataType;

/**
 * Class PurchaseOrderLine
 * @package Skuio\Sdk\DataType
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $sku
 * @property string $description
 * @property int $quantity
 * @property float $amount
 * @property float $tax
 * @property float $discount
 * @property Carbon $estimated_delivery_date
 * @property int $nominal_code_id
 * @property string|mixed|null $line_reference
 */
class PurchaseOrderLine extends DataType
{

}