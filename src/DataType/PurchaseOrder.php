<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 7/24/20
 * Time: 8:52 AM
 */

namespace Skuio\Sdk\DataType;

use Carbon\Carbon;
use Skuio\Sdk\DataType;

/**
 * Class PurchaseOrder
 * @package Skuio\Sdk\DataType
 *
 * @property int $id
 * @property Carbon $purchase_order_date
 * @property string $purchase_order_number
 * @property string $submission_format
 * @property string $submission_status
 * @property string $last_submitted_at
 * @property string $approval_status
 * @property int $payment_term_id
 * @property int $incoterm_id
 * @property int $shipping_method_id
 * @property int $supplier_id
 * @property int $supplier_warehouse_id
 * @property int $destination_warehouse_id
 * @property int $currency_id
 * @property string $currency_code
 * @property Carbon $estimated_delivery_date
 * @property string $supplier_notes
 * @property array $purchase_order_lines
 */
class PurchaseOrder extends DataType
{

  /**
   * Order Statuses
   */
  const STATUS_DRAFT  = 'draft';
  const STATUS_OPEN   = 'open';
  const STATUS_CLOSED = 'closed';
  const STATUS        = [
    self::STATUS_DRAFT,
    self::STATUS_OPEN,
    self::STATUS_CLOSED,
  ];

  // Approval Statuses
  const APPROVAL_STATUS_PENDING  = 'pending';
  const APPROVAL_STATUS_APPROVED = 'approved';
  const APPROVAL_STATUS          = [ self::APPROVAL_STATUS_PENDING, self::APPROVAL_STATUS_APPROVED ];

  /**
   * Submission Statuses
   */
  const SUBMISSION_STATUS_UNSUBMITTED             = 'unsubmitted';
  const SUBMISSION_STATUS_SUBMITTED               = 'submitted';
  const SUBMISSION_STATUS_CHANGE_REQUEST_SUPPLIER = 'change_supplier';
  const SUBMISSION_STATUS_CHANGE_REQUEST_BUYER    = 'change_buyer';
  const SUBMISSION_STATUS_FINALIZED               = 'finalized';
  const SUBMISSION_STATUS_CANCELED                = 'canceled'; // by Supplier (After Submission)
  const SUBMISSION_STATUS_VOIDED                  = 'voided '; // by Buyer (Before Submission)
  const SUBMISSION_STATUS                         = [
    self::SUBMISSION_STATUS_UNSUBMITTED,
    self::SUBMISSION_STATUS_SUBMITTED,
    self::SUBMISSION_STATUS_CHANGE_REQUEST_BUYER,
    self::SUBMISSION_STATUS_CHANGE_REQUEST_SUPPLIER,
    self::SUBMISSION_STATUS_FINALIZED,
    self::SUBMISSION_STATUS_CANCELED,
    self::SUBMISSION_STATUS_VOIDED,
  ];

  /**
   * Submission Format
   */
  const SUBMISSION_FORMAT_PDF_ATTACHMENT = 'email_pdf_attachment';
  const SUBMISSION_FORMAT_MANUAL         = 'manual';
  const SUBMISSION_FORMATS               = [
    self::SUBMISSION_FORMAT_PDF_ATTACHMENT,
    self::SUBMISSION_FORMAT_MANUAL,
  ];

  /**
   * Receipt Statuses
   */
  const RECEIPT_STATUS_UNRECEIVED         = 'unreceived';
  const RECEIPT_STATUS_RECEIVED           = 'received';
  const RECEIPT_STATUS_PARTIALLY_RECEIVED = 'partially_received';
  const RECEIPT_STATUS_DROPSHIP           = 'Dropship';
  const RECEIPT_STATUS                    = [
    self::RECEIPT_STATUS_UNRECEIVED,
    self::RECEIPT_STATUS_RECEIVED,
    self::RECEIPT_STATUS_PARTIALLY_RECEIVED,
    self::RECEIPT_STATUS_DROPSHIP,
  ];

  /**
   * Shipment Status
   */
  const SHIPMENT_STATUS_UNSHIPPED         = 'unshipped';
  const SHIPMENT_STATUS_SHIPPED_WAREHOUSE = 'shipped_to_warehouse';
  const SHIPMENT_STATUS_SHIPPED_CUSTOMER  = 'shipped_to_customer'; // In the case of dropship orders
  const SHIPMENT_STATUS                   = [
    self::SHIPMENT_STATUS_UNSHIPPED,
    self::SHIPMENT_STATUS_SHIPPED_WAREHOUSE,
    self::SHIPMENT_STATUS_SHIPPED_CUSTOMER,
  ];

  /**
   * Invoice statuses
   */
  const INVOICE_STATUS_UNINVOICED         = 'uninvoiced';
  const INVOICE_STATUS_PARTIALLY_INVOICED = 'partially_invoiced';
  const INVOICE_STATUS_INVOICED           = 'invoiced'; // Ready to submit to Accounting Software
  const INVOICE_STATUS_INVOICE_PAID       = 'invoice_paid'; // Can be determined by pulling status from Accounting Software
  const INVOICE_STATUS                    = [
    self::INVOICE_STATUS_UNINVOICED,
    self::INVOICE_STATUS_PARTIALLY_INVOICED,
    self::INVOICE_STATUS_INVOICED,
    self::INVOICE_STATUS_INVOICE_PAID,
  ];

  /**
   * Add purchase order line
   *
   * @param PurchaseOrderLine $purchaseOrderLine
   *
   * @return $this
   */
  public function addPurchaseOrderLine( PurchaseOrderLine $purchaseOrderLine )
  {
    if ( ! isset( $this->purchase_order_lines ) )
    {
      $this->purchase_order_lines = [];
    }

    $this->purchase_order_lines[] = $purchaseOrderLine;

    return $this;
  }

}