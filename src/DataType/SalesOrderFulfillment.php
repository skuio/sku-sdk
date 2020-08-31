<?php

namespace Skuio\Sdk\DataType;

use Skuio\Sdk\DataType;

/**
 * Class FulfillSalesOrderRequest
 *
 * @package Skuio\Sdk\DataType
 *
 * @property int $id
 * @property int $sales_order_id
 * @property int|null $warehouse_id
 * @property int $shipping_method_id
 * @property string $fulfilled_at
 * @property float|null $cost
 * @property string|null $tracking_number
 * @property array $fulfillment_lines
 */
class SalesOrderFulfillment extends DataType
{
  /**
   * Add line to fulfill
   *
   * @param int $salesOrderLineId
   * @param int $quantity
   */
  public function addFulfillmentLine( int $salesOrderLineId, int $quantity )
  {
    if ( ! isset( $this->fulfillment_lines ) )
    {
      $this->fulfillment_lines = [];
    }

    $this->fulfillment_lines[] = [ 'sales_order_line_id' => $salesOrderLineId, 'quantity' => $quantity ];
  }
}