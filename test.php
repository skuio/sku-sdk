<?php

include 'vendor/autoload.php';

use Skuio\Sdk\Model\Import;
use Skuio\Sdk\Model\Product;
use Skuio\Sdk\Model\SalesChannelBrand;
use Skuio\Sdk\Resource\ProductCategories;
use Skuio\Sdk\Resource\VendorPricingTiers;
use Skuio\Sdk\Resource\Products;
use Skuio\Sdk\Sdk;

/*
 |--------------------------------------------------------------------------
 | Config Credentials API
 |--------------------------------------------------------------------------
 */
$username = '2ba55486ae905bd900b402cbee5aba18';
$password = '11a2f00d5c99b3b1c4d148b07b182e7c';

Sdk::config( [ 'username' => $username, 'password' => $password, 'environment' => Sdk::DEVELOPMENT ] );

/*
 |--------------------------------------------------------------------------
 | Testing  products
 |--------------------------------------------------------------------------
 */

function importProducts( $username, $password )
{
  $import           = new Import();
  $import->csv_file = './tests/import_products_test2.csv';

  $products = new Products();
  $products = $products->import( $import );

  echo $products->getStatusCode() . '<br>';
  print_r( $products->getResponse() );
}

function createProduct( $username, $password )
{
  $product                 = new Product();
  $product->sku            = '12345678911';
  $product->name           = 'my first test';
  $product->brand_name     = 'test brand';
  $product->type           = 'standard';
  $product->weight         = 15.2;
  $product->image          = 'http://ecx.images-amazon.com/images/I/41HpVbFiyRL.jpg';
  $product->weight_unit    = 'kg';
  $product->height         = 5.4;
  $product->width          = 3.4;
  $product->length         = 2.4;
  $product->dimension_unit = 'cm';

  $products = new Products();

  $products = $products->store( $product );

  echo $products->getStatusCode() . '<br>';
  print_r( $products->getResponse() );
}

function bulkArchive( array $productIds )
{
  $product = new Products();

  $response = $product->bulkArchive( null, $productIds );

  echo $response->getStatusCode() . '<br>';
  print_r( $response->getResponse() );
}

/*
 |--------------------------------------------------------------------------
 | Testing  store, update and show operations at  SCB
 |--------------------------------------------------------------------------
 */

/**
 * test create SCB
 *
 * @throws Exception
 */
function createSalesChannelBrand()
{
  $salesChannelBrand = new SalesChannelBrand();

  $salesChannelBrand->name  = 'test name';
  $salesChannelBrand->email = 'dev@sku.io';

  $salesChannelBrands = new \Skuio\Sdk\Resource\SalesChannelBrands();

  $salesChannelBrands = $salesChannelBrands->store( $salesChannelBrand );

  echo $salesChannelBrands->getStatusCode() . '<br>';
  print_r( $salesChannelBrands->getResponse() );

}

/**
 * test show SCB by id
 *
 * @param $id
 *
 * @throws Exception
 */
function showSalesChannelBrandById( $id )
{
  $salesChannelBrandInstance = new \Skuio\Sdk\Resource\SalesChannelBrands();

  $salesChannelBrand = $salesChannelBrandInstance->show( $id );

  echo $salesChannelBrand->getStatusCode() . '<br>';

  print_r( $salesChannelBrand->getResponse() );

}

/**
 * test update SCB
 *
 * @throws Exception
 *
 */
function updateSalesChannelBrand()
{
  $salesChannelBrand = new SalesChannelBrand();

  $salesChannelBrand->id            = 5;
  $salesChannelBrand->name          = 'test name555';
  $salesChannelBrand->email         = 'dev@sku.io';
  $salesChannelBrand->company_name  = 'Sku';
  $salesChannelBrand->logo_url      = "http://ecx.images-amazon.com/images/I/41HpVbFiyRL.jpg";
  $salesChannelBrand->download_logo = true;
  $salesChannelBrand->address1      = "Uffgh";
  $salesChannelBrand->address2      = "gfdhgjgkj";
  $salesChannelBrand->address3      = "gdgghh";
  $salesChannelBrand->country       = "United States";
  $salesChannelBrand->country_code  = "US";
  $salesChannelBrand->zip           = "45896";
  $salesChannelBrand->city          = "NewYoruk";
  $salesChannelBrand->province      = "NewYoruk ghgh";
  $salesChannelBrand->province_code = "NN";
  $salesChannelBrand->phone         = "759862118589";

  $salesChannelBrands = new \Skuio\Sdk\Resource\SalesChannelBrands();

  $salesChannelBrands = $salesChannelBrands->update( $salesChannelBrand );

  echo $salesChannelBrands->getStatusCode() . '<br>';
  print_r( $salesChannelBrands->getResponse() );

}

/*
 |--------------------------------------------------------------------------
 | Testing  store, update and show operations at  Sales Order
 |--------------------------------------------------------------------------
 */

function createSalesOrder()
{
  $salesOrder = new \Skuio\Sdk\Model\SalesOrder();

  $salesOrder->sales_channel_id   = 1;
  $salesOrder->customer_reference = '211149608634-2142858820773553';
  $salesOrder->status             = 'open';
  $salesOrder->currency_code      = 'USD';
  $salesOrder->discount           = 10;
  $salesOrder->order_date         = '2019-06-19T06:46:27+00:00';
  $salesOrder->receive_by_date    = '2019-06-19T06:46:27+00:00';
  $salesOrder->warehouse_id       = 1;
  $salesOrder->shipping_method_id = 1;

  $billing_address               = new \Skuio\Sdk\Model\Address();
  $billing_address->name         = 'Ahmed';
  $billing_address->email        = 'ahmed@sku.io';
  $billing_address->address1     = 'Gaza';
  $billing_address->city         = 'Gaza';
  $billing_address->country_code = 'PS';
  $billing_address->country      = 'Palestine';

  $shipping_address               = new \Skuio\Sdk\Model\Address();
  $shipping_address->name         = 'Ahmed';
  $shipping_address->email        = 'ahmed@sku.io';
  $shipping_address->address1     = 'Gaza';
  $shipping_address->city         = 'Gaza';
  $shipping_address->country_code = 'PS';
  $shipping_address->country      = 'Palestine';

  $customer_address               = new \Skuio\Sdk\Model\Address();
  $customer_address->name         = 'Ahmed';
  $customer_address->email        = 'ahmed@sku.io';
  $customer_address->address1     = 'Gaza';
  $customer_address->city         = 'Gaza';
  $customer_address->country_code = 'PS';
  $customer_address->country      = 'Palestine';

  $sales_order_line                        = new \Skuio\Sdk\Model\SalesOrderLine();
  $sales_order_line->description           = 'item 1';
  $sales_order_line->sales_channel_line_id = 'wompro30ct';
  $sales_order_line->amount                = 12;
  $sales_order_line->quantity              = 3;
  $sales_order_line->tax                   = 0.2;
  $sales_order_line->discount              = 20;
  $sales_order_line->product_id            = 1;

  $sales_order_line2                        = new \Skuio\Sdk\Model\SalesOrderLine();
  $sales_order_line2->description           = 'item 1';
  $sales_order_line2->sales_channel_line_id = 'wompro30ct';
  $sales_order_line2->amount                = 12;
  $sales_order_line2->quantity              = 3;
  $sales_order_line2->tax                   = 0.2;
  $sales_order_line2->discount              = 20;
  $sales_order_line2->nominal_code_id       = 1;

  $salesOrder->billing_address   = $billing_address;
  $salesOrder->shipping_address  = $shipping_address;
  $salesOrder->customer_address  = $customer_address;
  $salesOrder->sales_order_lines = [ $sales_order_line, $sales_order_line2 ];

  $salesOrders = new \Skuio\Sdk\Resource\SalesOrders();

  $salesOrderStore = $salesOrders->store( $salesOrder );

  echo $salesOrderStore->getStatusCode() . '<br>';
  print_r( $salesOrderStore->getData() );

}

function salesOrderConstants()
{
  $constants = new \Skuio\Sdk\Resource\SalesOrders();

  $constantsData = $constants->constants();

  echo $constantsData->getStatusCode() . '<br>';
  print_r( $constantsData->getResponse() );

}

function archiveSalesOrder( $id )
{
  $salesOrder = new \Skuio\Sdk\Resource\SalesOrders();

  $response = $salesOrder->archive( $id );

  echo $response->getStatusCode() . '<br>';
  print_r( $response->getResponse() );

}

function unArchiveSalesOrder( $id )
{
  $salesOrder = new \Skuio\Sdk\Resource\SalesOrders();

  $response = $salesOrder->unarchived( $id );

  echo $response->getStatusCode() . '<br>';
  print_r( $response->getResponse() );

}

function showSalesOrder( $id )
{
  $salesOrder = new \Skuio\Sdk\Resource\SalesOrders();

  $response = $salesOrder->show( $id );

  echo $response->getStatusCode() . '<br>';
  print_r( $response->getResponse() );

}

/**
 * @param $name
 * @param $zip
 * @param $address1
 *
 * @throws Exception
 */
function findMatchCustomers( $name, $zip, $address1 )
{
  $customersInstance = new \Skuio\Sdk\Resource\Customers();

  $customers = $customersInstance->findMatch( $name, $zip, $address1 );

  echo $customers->getCurlError() . '<br>';
  print_r( $customers->getData() );

}

//$products = new \Skuio\Sdk\Resource\VendorPricingTiers();
//
//$inventoryMovements = $products->get();

//print_r( $inventoryMovements->getStatusCode() );
//echo "\n";
//print_r( $inventoryMovements->getMessage() );
//echo "\n";
//print_r( $inventoryMovements->getResponse() );
//echo "\n";
//print_r( $inventoryMovements->getErrors() );

//createSalesOrder();
//salesOrderConstants();

//archiveSalesOrder( 35 );
//showSalesOrder( 35 );

findMatchCustomers( 'Ayesha', 'ghghgfftghj', '660 EBERSOLE RD' );

//bulkArchive( [ 1, 2 ] );
//echo '<br>----------------<br>';
//importProducts( $username, $password );