<?php

namespace Skuio\Sdk\Model;

use Skuio\Sdk\Model;

/**
 * Class SalesOrder
 *
 * @package Skuio\Sdk\Model
 *
 * @property int $id
 * @property int $sales_channel_id
 * @property string $customer_reference
 * @property string $status
 * @property string $currency_code
 * @property string $order_date
 * @property string $receive_by_date
 * @property string $payment_date
 * @property string $ship_by_date
 * @property float $total_tax
 * @property float $total_shipping
 * @property float $total_shipping_tax
 * @property float $total_discount
 * @property SalesOrderLine[] $sales_order_lines
 * @property Address $shipping_address
 * @property Address $billing_address
 * @property int $customer_id
 * @property Address $customer_address
 */
class SalesOrder extends Model
{

}