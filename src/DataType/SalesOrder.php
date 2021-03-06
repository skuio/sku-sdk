<?php

namespace Skuio\Sdk\DataType;

use Skuio\Sdk\DataType;

/**
 * Class SalesOrder
 *
 * @package Skuio\Sdk\DataType
 *
 * @property int $id
 * @property string|null $sales_order_number
 * @property int|null $store_id
 * @property string|null $store_name
 * @property int|null $shipping_method_id
 * @property string $order_status
 * @property int|null $customer_id
 * @property int|null $shipping_address_id
 * @property int|null $billing_address_id
 * @property string|null $payment_status
 * @property int|null $currency_id
 * @property string|null $currency_code
 * @property string $order_date
 * @property string|null $payment_date
 * @property string|null $ship_by_date
 * @property string|null $receive_by_date
 * @property string|null $fulfilled_at required if order_status is closed
 * @property string|null $tracking_number only used if order_status is closed
 *
 * @property Address|null $customer
 * @property Address|null $shipping_address
 * @property Address|null $billing_address
 * @property SalesOrderLine[]|null $sales_order_lines
 */
class SalesOrder extends DataType
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
    $this->customer = $customerAddress;

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