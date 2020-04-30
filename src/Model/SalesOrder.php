<?php

namespace Skuio\Sdk\Model;

use Skuio\Sdk\Model;

/**
 * Class SalesOrder
 *
 * @package Skuio\Sdk\Model
 *
 * @property int $id
 * @property string $customer_reference
 * @property int|null $sales_channel_brand_id
 * @property string|null $sales_channel_brand_name
 * @property string $status
 * @property int|null $customer_id
 * @property int|null $shipping_address_id
 * @property int|null $billing_address_id
 * @property float|null $discount
 * @property float|null $total
 * @property int|null $warehouse_id
 * @property int|null $shipping_method_id
 * @property string $currency_code
 * @property string|null $payment_status
 * @property string $order_date
 * @property string|null $payment_date
 * @property string|null $ship_by_date
 * @property string|null $receive_by_date
 * @property array $shipping_address
 * @property array $billing_address
 * @property array $customer_address
 * @property array $sales_order_lines
 */
class SalesOrder extends Model
{

  /**
   * Order Status
   */
  const STATUS_DRAFT  = 'draft';
  const STATUS_OPEN   = 'open';
  const STATUS_CLOSED = 'closed';
  const STATUSES      = [
    self::STATUS_DRAFT,
    self::STATUS_OPEN,
    self::STATUS_CLOSED,
  ];

  /**
   * Set shipping address
   *
   * @param Address $shippingAddress
   *
   * @return $this
   */
  public function setShippingAddress( Address $shippingAddress )
  {
    $this->shipping_address = $shippingAddress;

    return $this;
  }

  /**
   * Set billing address
   *
   * @param Address $billingAddress
   *
   * @return $this
   */
  public function setBillingAddress( Address $billingAddress )
  {
    $this->billing_address = $billingAddress;

    return $this;
  }

  /**
   * Set customer address
   *
   * @param Address $customerAddress
   *
   * @return $this
   */
  public function setCustomerAddress( Address $customerAddress )
  {
    $this->customer_address = $customerAddress;

    return $this;
  }

  /**
   * Add sales order line
   *
   * @param SalesOrderLine $salesOrderLine
   *
   * @return $this
   */
  public function addSalesOrderLine( SalesOrderLine $salesOrderLine )
  {
    if ( ! isset( $this->sales_order_lines ) )
    {
      $this->sales_order_lines = [];
    }

    $this->sales_order_lines[] = $salesOrderLine;

    return $this;
  }
}