<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Model\Vendor;
use Skuio\Sdk\Resource\Vendors;
use Skuio\Sdk\Sdk;
use Skuio\Sdk\Model\Warehouse;
use Skuio\Sdk\Model\WarehouseLocation;

class VendorsTest extends TestCase
{
  private $username = 'e89c5ec96cdbfe1f50f015ae5161c65f';
  private $password = '1656c8a98da2522be959d7523f011a86';


  private function deleteVendorById($vendorId){
      Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );
      $vendors = new Vendors();
      $vendors->delete($vendorId);
  }

  public function testGetVendors()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $vendors = new Vendors();
    $vendors = $vendors->get();

    $this->assertEquals( 200, $vendors->getStatusCode(), json_encode( $vendors->getResponse() ) );
  }

  public function testCreateVendor(){
      Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

      $vendor = new Vendor();
      $vendor->name = 'Default Vendor API';
      $vendor->is_supplier = false;

      $vendors = new Vendors();
      $response = $vendors->store($vendor);
      $this->assertEquals(200, $response->getStatusCode(), json_encode($response->getResponse()));

      // Clean up
      $this->deleteVendorById($response->getData()['id']);
  }

  public function testCreateVendorWithWarehouse(){
      Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

      $vendor = new Vendor();
      $vendor->name = 'Default Vendor API';
      $vendor->is_supplier = false;

      $warehouse = new Warehouse();
      $warehouse->name = 'Default Vendor Warehouse API';

      // Add to vendor
      $vendor->addWarehouse($warehouse);

      $vendors = new Vendors();
      $response = $vendors->store($vendor);
      $this->assertEquals(200, $response->getStatusCode(), json_encode($response->getResponse()));


      // Clean up
      $this->deleteVendorById($response->getData()['id']);
  }


}