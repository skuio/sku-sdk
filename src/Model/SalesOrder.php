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
  public function setShippingAddress(Address $shippingAddress){
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
  public function setBillingAddress(Address $billingAddress){
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
  public function setCustomerAddress(Address $customerAddress){
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