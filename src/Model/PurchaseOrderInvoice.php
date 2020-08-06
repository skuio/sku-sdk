<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 7/31/20
 * Time: 1:06 AM
 */

namespace Skuio\Sdk\Model;


use Carbon\Carbon;
use Skuio\Sdk\Model;

/**
 * Class PurchaseOrderInvoice
 * @package Skuio\Sdk\Model
 *
 * @property int $purchase_order_id
 * @property Carbon $purchase_invoice_date
 * @property string $supplier_invoice_number
 * @property array $purchase_invoice_lines
 * @property  string $status
 */
class PurchaseOrderInvoice extends Model
{

    /**
     * @param int $purchaseOrderLineId
     * @param int $quantity
     */
    public function addInvoiceLine(int $purchaseOrderLineId, int $quantity )
    {
        if ( ! isset( $this->purchase_invoice_lines ) )
        {
            $this->purchase_invoice_lines = [];
        }

        $this->purchase_invoice_lines[] = [ 'purchase_order_line_id' => $purchaseOrderLineId, 'quantity_invoiced' => $quantity ];
    }

    /**
     * @param $purchaseOrderLineReference
     * @param int $quantity
     */
    public function addInvoiceLineByReference($purchaseOrderLineReference, int $quantity )
    {
        if ( ! isset( $this->purchase_invoice_lines ) )
        {
            $this->purchase_invoice_lines = [];
        }

        $this->purchase_invoice_lines[] = [ 'purchase_order_line_reference' => $purchaseOrderLineReference, 'quantity_invoiced' => $quantity ];
    }

}