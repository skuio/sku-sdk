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
     * @param int $invoiceLineId
     * @param int $quantity
     */
    public function addInvoiceLine(int $invoiceLineId, int $quantity )
    {
        if ( ! isset( $this->purchase_invoice_lines ) )
        {
            $this->purchase_invoice_lines = [];
        }

        $this->purchase_invoice_lines[] = [ 'id' => $invoiceLineId, 'quantity' => $quantity ];
    }

}