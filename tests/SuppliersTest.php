<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\Model\Supplier;
use Skuio\Sdk\Resource\Suppliers;
use Skuio\Sdk\Sdk;
use Skuio\Sdk\Model\Warehouse;

class SuppliersTest extends TestCase
{
  private $username = 'e89c5ec96cdbfe1f50f015ae5161c65f';
  private $password = '1656c8a98da2522be959d7523f011a86';


  private function deleteSupplierById($supplierId){
      Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );
      $suppliers = new Suppliers();
      $suppliers->delete($supplierId);
  }

  public function testGetSuppliers()
  {
    Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

    $suppliers = new Suppliers();
    $suppliers = $suppliers->get();

    $this->assertEquals( 200, $suppliers->getStatusCode(), json_encode( $suppliers->getResponse() ) );
  }

  public function testCreateSupplier(){
      Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

      $supplier = new Supplier();
      $supplier->name = 'Default Supplier API';

      $suppliers = new Suppliers();
      $response = $suppliers->store($supplier);
      $this->assertEquals(200, $response->getStatusCode(), json_encode($response->getResponse()));

      // Clean up
      $this->deleteSupplierById($response->getData()['id']);
  }

  public function testCreateSupplierWithWarehouse(){
      Sdk::config( [ 'username' => $this->username, 'password' => $this->password, 'environment' => Sdk::DEVELOPMENT ] );

      $supplier = new Supplier();
      $supplier->name = 'Default Supplier API';

      $warehouse = new Warehouse();
      $warehouse->name = 'Default Supplier Warehouse API';
      $warehouse->address_name = 'Supplier Address Name';
      $warehouse->address1 = '123 High St';
      $warehouse->zip = '12345';

      // Add to supplier
      $supplier->addWarehouse($warehouse);

      $suppliers = new Suppliers();
      $response = $suppliers->store($supplier);
      $this->assertEquals(200, $response->getStatusCode(), json_encode($response->getResponse()));


      // Clean up
      $this->deleteSupplierById($response->getData()['id']);
  }


}