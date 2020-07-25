<?php

namespace Skuio\Sdk\Request;

use Skuio\Sdk\Model;

/**
 * Class FulfillSalesOrderRequest
 *
 * @package Skuio\Sdk\Request
 *
 * @property int $sales_order_id
 * @property int|null $warehouse_id
 * @property int $shipping_method_id
 * @property string $fulfilled_at
 * @property float|null $cost
 * @property string|null $tracking_number
 * @property array $sales_order_lines
 */
class FulfillSalesOrderRequest extends Model
{
  /**
   * Add line to fulfill
   *
   * @param int $salesOrderId
   * @param int $quantity
   */
  public function addFulfillmentLine( int $salesOrderId, int $quantity )
  {
    if ( ! isset( $this->sales_order_lines ) )
    {
      $this->sales_order_lines = [];
    }

    $this->sales_order_lines[] = [ 'id' => $salesOrderId, 'quantity' => $quantity ];
  }
}