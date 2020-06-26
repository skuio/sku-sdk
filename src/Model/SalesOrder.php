<?php

namespace Skuio\Sdk\Model;

use Skuio\Sdk\Model;

/**
 * Class SalesOrder
 *
 * @package Skuio\Sdk\Model
 *
 * @property int $id
 * @property string|null $sales_order_number
 * @property int|null $store_id
 * @property string|null $store_name
 * @property string $order_status
 * @property string|null $fulfillment_status
 * @property int|null $customer_id
 * @property int|null $shipping_address_id
 * @property int|null $billing_address_id
 * @property int|null $shipping_method_id
 * @property string|null $currency_code
 * @property string|null $payment_status
 * @property string $order_date
 * @property string|null $payment_date
 * @property string|null $ship_by_date
 * @property string|null $receive_by_date
 * @property Address|null $shipping_address
 * @property Address|null $billing_address
 * @property array $sales_order_lines
 * @property int|null $currency_id
 * @property Address|null $customer
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
   * Fulfillment Statues
   */
  const FULFILLMENT_STATUS_UNFULFILLED         = 'unfulfilled';
  const FULFILLMENT_STATUS_PARTIALLY_FULFILLED = 'partially_fulfilled';
  const FULFILLMENT_STATUS_FULFILLED           = 'fulfilled';
  const FULFILLMENT_STATUES                    = [
    self::FULFILLMENT_STATUS_UNFULFILLED,
    self::FULFILLMENT_STATUS_PARTIALLY_FULFILLED,
    self::FULFILLMENT_STATUS_FULFILLED,
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