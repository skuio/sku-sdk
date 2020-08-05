<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 7/24/20
 * Time: 11:24 AM
 */

namespace Skuio\Sdk\Model;


use Carbon\Carbon;
use Skuio\Sdk\Model;

/**
 * Class PurchaseOrderShipment
 * @package Skuio\Sdk\Model
 *
 * @property int $purchase_order_id
 * @property Carbon $shipment_date
 * @property int $shipping_method_id
 * @property string $tracking
 * @property array $shipment_lines
 */
class PurchaseOrderShipment extends Model
{

    /**
     * @param int $purchaseOrderLineId
     * @param int $quantity
     */
    public function addShipmentLine(int $purchaseOrderLineId, int $quantity){
        if(!isset($this->shipment_lines)){
            $this->shipment_lines = [];
        }

        $this->shipment_lines[] = [
            'purchase_order_line_id' => $purchaseOrderLineId,
            'quantity' => $quantity
        ];
    }

    /**
     * @param $reference
     * @param int $quantity
     */
    public function addShipmentLineByReference($reference, int $quantity){
        if(!isset($this->shipment_lines)){
            $this->shipment_lines = [];
        }

        $this->shipment_lines[] = [
            'line_reference' => $reference,
            'quantity' => $quantity
        ];
    }

}