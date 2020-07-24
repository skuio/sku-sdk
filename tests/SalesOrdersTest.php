<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Model\Address;
use Skuio\Sdk\Model\Import;
use Skuio\Sdk\Model\SalesOrder;
use Skuio\Sdk\Model\SalesOrderLine;
use Skuio\Sdk\Request;
use Skuio\Sdk\Resource\SalesOrderLines;
use Skuio\Sdk\Resource\SalesOrders;
use Skuio\Sdk\Sdk;

class SalesOrdersTest extends TestCase
{
  private $username = 'e89c5ec96cdbfe1f50f015ae5161c65f';
  private $password = '1656c8a98da2522be959d7523f011a86';


    /**
     * Deletes a sales order by id
     *
     * @param $salesOrderId
     */
    private function deleteSalesOrderById($salesOrderId){
        Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

        $salesOrders = new SalesOrders();
        $salesOrders = $salesOrders->delete( $salesOrderId );

//        $this->assertEquals( 200, $salesOrders->getStatusCode(), json_encode( $salesOrders->getResponse() ) );
    }

    private function makeSaleOrder(): SalesOrder{
        $salesOrder                     = new SalesOrder();
        $salesOrder->order_status       = SalesOrder::STATUS_DRAFT;
        $salesOrder->currency_id      = 39;
        $salesOrder->order_date         = '2019-09-17T06:46:27+00:00';

        $salesOrderLine              = new SalesOrderLine();
        $salesOrderLine->description = 'Walbro GSL392 255 LPH High Pressure Inline Fuel Pump (NO KIT INCLUDED)';
        $salesOrderLine->sku         = 'GSL392';
        $salesOrderLine->quantity    = 2;
        $salesOrderLine->amount      = 130.5;
        $salesOrderLine->tax         = 0;

        $salesOrder->sales_order_lines = [ $salesOrderLine ];

        $customerAddress               = new Address();
        $customerAddress->name         = 'Ahmad';
        $customerAddress->email        = 'ahmad@sku.io';
        $customerAddress->address1     = 'Gaza';
        $customerAddress->city         = 'Gaza';
        $customerAddress->country_code = 'PS';

        $salesOrder->customer = $customerAddress;

        return $salesOrder;
    }

  public function testGetSalesOrders()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $request = new Request();

    $salesOrders = new SalesOrders();
    $salesOrders = $salesOrders->get( $request );

    $this->assertEquals( 200, $salesOrders->getStatusCode(), json_encode( $salesOrders->getResponse() ) );
  }

  public function testShowSalesOrder()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $salesOrderId = 3128;

    $salesOrders = new SalesOrders();
    $salesOrders = $salesOrders->show( $salesOrderId );

    $this->assertEquals( 200, $salesOrders->getStatusCode(), json_encode( $salesOrders->getResponse() ) );
  }

  public function testStoreSalesOrder()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $salesOrders = new SalesOrders();
    $salesOrders = $salesOrders->store( $this->makeSaleOrder() );

    $this->assertLessThanOrEqual( 201, $salesOrders->getStatusCode(), json_encode( $salesOrders->getResponse() ) );

    // Remove sales order
    $this->deleteSalesOrderById($salesOrders->getData()['id']);
  }

  public function testUpdateSalesOrder()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $salesOrder = $this->makeSaleOrder();

    $salesOrders = new SalesOrders();
    $response = $salesOrders->store($salesOrder);

    $salesOrder->id = $response->getData()['id'];

    $salesOrders = $salesOrders->update( $salesOrder );

    $this->assertEquals( 200, $salesOrders->getStatusCode(), json_encode( $salesOrders->getResponse() ) );

    // Remove sale order
    $this->deleteSalesOrderById($salesOrders->getData()['id']);
  }


//  public function testImportSalesOrders()
//  {
//    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );
//
//    $import           = new Import();
//    $import->csv_file = './tests/import_sales_orders_test.csv';
//
//    $salesOrders = new SalesOrders();
//    $salesOrders = $salesOrders->import( $import );
//
//    print_r( $salesOrders->getResponse() );
//
//    $this->assertEquals( 200, $salesOrders->getStatusCode(), json_encode( $salesOrders->getResponse() ) );
//  }
//
//  public function deleteSalesOrderLine()
//  {
//    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );
//
//    $salesOrderLineId = 1;
//
//    $salesOrderLines = new SalesOrderLines();
//    $salesOrderLines = $salesOrderLines->delete( $salesOrderLineId );
//
//    $this->assertEquals( 200, $salesOrderLines->getStatusCode(), json_encode( $salesOrderLines->getResponse() ) );
//  }
}