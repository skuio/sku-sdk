<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 7/31/20
 * Time: 12:18 AM
 */

namespace Skuio\Sdk\DataType;


use Carbon\Carbon;
use Skuio\Sdk\DataType;

/**
 * Class ReceivePurchaseOrderRequest
 * @package Skuio\Sdk\Request
 *
 * @property int $id
 * @property int $purchase_order_id
 * @property int $purchase_order_shipment_id
 * @property Carbon $received_at
 * @property int $warehouse_id
 * @property array $receipt_lines
 */
class PurchaseOrderReceipt extends DataType
{

    /**
     * @param int $shipmentLineId
     * @param int $quantity
     */
    public function addShipmentReceiptLine(int $shipmentLineId, int $quantity){
        if ( ! isset( $this->receipt_lines ) )
        {
            $this->receipt_lines = [];
        }

        $this->receipt_lines[] = [ 'purchase_order_shipment_line_id' => $shipmentLineId, 'quantity' => $quantity ];
    }

    /**
     * @param $reference
     * @param int $quantity
     */
    public function addShipmentReceiptLineByReference($reference, int $quantity){
        if ( ! isset( $this->receipt_lines ) )
        {
            $this->receipt_lines = [];
        }

        $this->receipt_lines[] = [ 'purchase_order_line_reference' => $reference, 'quantity' => $quantity ];
    }


}