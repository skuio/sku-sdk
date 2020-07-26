<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 7/24/20
 * Time: 9:13 AM
 */

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Model\PurchaseOrderLine;
use Skuio\Sdk\Request;
use Skuio\Sdk\Resource\PurchaseOrders;
use Skuio\Sdk\Sdk;
use Skuio\Sdk\Model\PurchaseOrder;
use Carbon\Carbon;

class PurchaseOrdersTest extends TestCase
{

    private $username = 'e89c5ec96cdbfe1f50f015ae5161c65f';
    private $password = '1656c8a98da2522be959d7523f011a86';

    /**
     * Deletes a purchase order by id
     *
     * @param $purchaseOrderId
     */
    private function deletePurchaseOrderById($purchaseOrderId){
        Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

        $purchaseOrders = new PurchaseOrders();
        $response = $purchaseOrders->bulkDelete( null, [$purchaseOrderId] );

        $this->assertEquals( 200, $response->getStatusCode(), json_encode( $response->getResponse() ) );
    }

    private function makePurchaseOrder($status = PurchaseOrder::APPROVAL_STATUS_PENDING): PurchaseOrder{
        $purchaseOrder                     = new PurchaseOrder();
        $purchaseOrder->approval_status       = $status;
        $purchaseOrder->currency_id      = 39;
        $purchaseOrder->purchase_order_date         = Carbon::now()->toDateTimeString();
        $purchaseOrder->vendor_id = 1;
        $purchaseOrder->currency_code = 'USD';

        $purchaseOrderLine              = new PurchaseOrderLine();
        $purchaseOrderLine->description = 'Walbro GSL392 255 LPH High Pressure Inline Fuel Pump (NO KIT INCLUDED)';
        $purchaseOrderLine->sku         = "GSL392";
        $purchaseOrderLine->quantity    = 2;
        $purchaseOrderLine->amount      = 130.5;
        $purchaseOrderLine->tax         = 0;
        $purchaseOrderLine->discount    = 0;

        $purchaseOrder->purchase_order_lines = [ $purchaseOrderLine ];

        return $purchaseOrder;
    }

    /**
     * @return array|null
     */
    private function createPurchaseOrder(){
        $purchaseOrders = new PurchaseOrders();
        $response = $purchaseOrders->store($this->makePurchaseOrder());
        return $response->getData();
    }

    public function testGetPurchaseOrders()
    {
        Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

        $request = new Request();

        $purchaseOrders = new PurchaseOrders();
        $response = $purchaseOrders->get( $request );

        $this->assertEquals( 200, $response->getStatusCode(), json_encode( $response->getResponse() ) );
    }

    public function testShowPurchaseOrder()
    {
        Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

        $purchaseOrder = $this->createPurchaseOrder();

        $purchaseOrders = new PurchaseOrders();
        $response = $purchaseOrders->show($purchaseOrder['id']);

        $this->assertEquals( 200, $response->getStatusCode(), json_encode( $response->getResponse() ) );

        $this->deletePurchaseOrderById($purchaseOrder['id']);
    }

    public function testStorePurchaseOrder()
    {
        Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

        $purchaseOrders = new PurchaseOrders();
        $response = $purchaseOrders->store( $this->makePurchaseOrder(PurchaseOrder::APPROVAL_STATUS_APPROVED) );

        $this->assertLessThanOrEqual( 201, $response->getStatusCode(), json_encode( $response->getResponse() ) );

        $this->deletePurchaseOrderById($response->getData()['id']);
    }

    public function testUpdatePurchaseOrder()
    {
        Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

        $purchaseOrder = $this->makePurchaseOrder();

        $purchaseOrders = new PurchaseOrders();
        $response = $purchaseOrders->store($purchaseOrder);

        $purchaseOrder->id = $response->getData()['id'];

        $response = $purchaseOrders->update( $purchaseOrder );


        $this->assertEquals( 200, $response->getStatusCode(), json_encode( $response->getResponse() ) );

        $this->deletePurchaseOrderById($response->getData()['id']);
    }


    public function testSubmitPurchaseOrder()
    {
        Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

        $purchaseOrder = $this->makePurchaseOrder();

        $purchaseOrders = new PurchaseOrders();
        $response = $purchaseOrders->store($purchaseOrder);

        $purchaseOrder->id = $response->getData()['id'];

        $response = $purchaseOrders->submit( $purchaseOrder );

        $this->assertEquals( 200, $response->getStatusCode(), json_encode( $response->getResponse() ) );
        $this->assertEquals($response->getData()['order_status'], PurchaseOrder::STATUS_OPEN);

        $this->deletePurchaseOrderById($response->getData()['id']);

    }


}