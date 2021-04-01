<?php

use PHPUnit\Framework\TestCase;
use Skuio\Sdk\DataType\Address;
use Skuio\Sdk\DataType\Supplier;
use Skuio\Sdk\Service\Suppliers;
use Skuio\Sdk\Sdk;
use Skuio\Sdk\DataType\Warehouse;

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

      // Add address with Address object
      $address = new Address();
//      $address->name = 'Office Address';
      $address->address1 = '123 High St.';
      $address->address2 = 'Unit 4483';
      $address->address3 = 'Left Lane';
      $address->country_code = 'US';
      $address->zip = '90210';
      $address->city = 'Los Angeles';
      $address->province = 'California';
      $address->province_code = 'CA';
      $supplier->addOfficeAddress($address);


      // Add address with array
//      $supplier->addOfficeAddress([
//         'label' => 'Address Name',
//         'email' => 'office@supplier.com',
//         'country_code' => 'US',
//         'zip' => '90210'
//      ]);

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