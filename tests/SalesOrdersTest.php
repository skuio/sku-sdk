<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Model\Address;
use Skuio\Sdk\Model\Import;
use Skuio\Sdk\Model\SalesOrder;
use Skuio\Sdk\Model\SalesOrderLine;
use Skuio\Sdk\Request;
use Skuio\Sdk\Resource\SalesOrderLines;
use Skuio\Sdk\Resource\SalesOrders;

class SalesOrdersTest extends TestCase
{
  private $username = '49a683831249ef6a37158f1e1b86e6d5';
  private $password = 'd002707ff6867c1c545adf40ab06bbdf';

  public function testGetSalesOrders()
  {
    $request = new Request();

    $salesOrders = new SalesOrders( $this->username, $this->password, true );
    $salesOrders = $salesOrders->get( $request );

    $this->assertEquals( 200, $salesOrders->getCode(), json_encode( $salesOrders->getResponse() ) );
  }

  public function testShowSalesOrder()
  {
    $salesOrderId = 1;

    $salesOrders = new SalesOrders( $this->username, $this->password, true );
    $salesOrders = $salesOrders->show( $salesOrderId );

    $this->assertEquals( 200, $salesOrders->getCode(), json_encode( $salesOrders->getResponse() ) );
  }

  public function testStoreSalesOrder()
  {
    $salesOrder                     = new SalesOrder();
    $salesOrder->sales_channel_id   = 1;
    $salesOrder->customer_reference = '789456-123456';
    $salesOrder->status             = 'draft';
    $salesOrder->currency_code      = 'USD';
    $salesOrder->order_date         = '2019-09-17T06:46:27+00:00';

    $salesOrderLine              = new SalesOrderLine();
    $salesOrderLine->description = 'Klairs Brightening and Balancing Starting Set';
    $salesOrderLine->sku         = 'KLR034';
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

    $salesOrder->customer_address = $customerAddress;

    $salesOrders = new SalesOrders( $this->username, $this->password, true );
    $salesOrders = $salesOrders->store( $salesOrder );

    $this->assertLessThanOrEqual( 201, $salesOrders->getCode(), json_encode( $salesOrders->getResponse() ) );
  }

  public function testUpdateSalesOrder()
  {
    $salesOrder                     = new SalesOrder();
    $salesOrder->id                 = 2;
    $salesOrder->sales_channel_id   = 1;
    $salesOrder->customer_reference = '7894561-1234562';
    $salesOrder->status             = 'draft';
    $salesOrder->currency_code      = 'USD';
    $salesOrder->order_date         = '2019-09-17T06:46:27+00:00';

    $salesOrderLine              = new SalesOrderLine();
    $salesOrderLine->description = 'Klairs Brightening and Balancing Starting Set';
    $salesOrderLine->sku         = 'KLR034';
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

    $salesOrder->customer_address = $customerAddress;

    $salesOrders = new SalesOrders( $this->username, $this->password, true );
    $salesOrders = $salesOrders->update( $salesOrder );

    $this->assertEquals( 200, $salesOrders->getCode(), json_encode( $salesOrders->getResponse() ) );
  }

  public function testDeleteSalesOrder()
  {
    $salesOrderId = 1;

    $salesOrders = new SalesOrders( $this->username, $this->password, true );
    $salesOrders = $salesOrders->delete( $salesOrderId );

    $this->assertEquals( 200, $salesOrders->getCode(), json_encode( $salesOrders->getResponse() ) );
  }

  public function testImportSalesOrders()
  {
    $import           = new Import();
    $import->csv_file = './tests/import_sales_orders_test.csv';

    $salesOrders = new SalesOrders( $this->username, $this->password, true );
    $salesOrders = $salesOrders->import( $import );

    print_r( $salesOrders->getResponse() );

    $this->assertEquals( 200, $salesOrders->getCode(), json_encode( $salesOrders->getResponse() ) );
  }

  public function deleteSalesOrderLine()
  {
    $salesOrderLineId = 1;

    $salesOrderLines = new SalesOrderLines( $this->username, $this->password, true );
    $salesOrderLines = $salesOrderLines->delete( $salesOrderLineId );

    $this->assertEquals( 200, $salesOrderLines->getCode(), json_encode( $salesOrderLines->getResponse() ) );
  }
}