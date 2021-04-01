<?php

namespace Skuio\Sdk\Service;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\DataType\Supplier;
use Skuio\Sdk\DataType\SupplierProduct;
use Skuio\Sdk\DataType\Warehouse;
use Skuio\Sdk\Query;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class Suppliers extends Sdk
{
  protected $endpoint = 'suppliers';

  /**
   * Retrieve suppliers
   *
   * @param Query|null $request
   *
   * @return Response
   * @throws Exception
   */
  public function get(Query $request = null )
  {
    if ( ! $request )
    {
      $request = new Query();
    }

    return $this->authorizedRequest( $this->endpoint . '?' . $request->getParams() );
  }

  /**
   * Create a new supplier
   *
   * @param Supplier $supplier
   *
   * @return Response
   * @throws Exception
   */
  public function store(Supplier $supplier )
  {
    // Create the supplier
    $response = $this->afterStore(
        $supplier,
        $this->authorizedRequest( $this->endpoint, $supplier->toJson(), Sdk::METHOD_POST )
    );

    $supplierId = $response->getData()['id'];
    // If warehouse is provided, we create the warehouse for the supplier
    if(isset($supplier->warehouse)){
        $this->createWarehouse($supplierId, $supplier->warehouse);
    }

    return $response;
  }

  /**
   * Update a supplier
   *
   * @param Supplier $supplier
   *
   * @return Response
   * @throws Exception
   */
  public function update(Supplier $supplier )
  {
    if ( empty( $supplier->id ) )
    {
      throw new InvalidArgumentException( 'The "id" field is required' );
    }

    return $this->authorizedRequest( "{$this->endpoint}/$supplier->id", $supplier->toJson(), Sdk::METHOD_PUT );
  }

  /**
   * Archive a supplier
   *
   * @param int $id
   *
   * @return Response
   * @throws Exception
   */
  public function archive( int $id )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$id}/archive", null, self::METHOD_PUT );
  }

  /**
   * Unarchived a supplier
   *
   * @param int $id
   *
   * @return Response
   * @throws Exception
   */
  public function unarchived( int $id )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$id}/unarchived", null, self::METHOD_PUT );
  }

  /**
   * View a list of supplier products
   *
   * @param int $id supplier id
   *
   * @return Response
   * @throws Exception
   */
  public function products( int $id )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$id}/products" );
  }

  /**
   * Create a new supplier product
   *
   * @param SupplierProduct $supplierProduct
   *
   * @return Response
   * @throws Exception
   */
  public function storeSupplierProduct(SupplierProduct $supplierProduct )
  {
    return $this->authorizedRequest( "supplier-products", $supplierProduct->toJson(), Sdk::METHOD_POST );
  }

  /**
   * Update a supplier product
   *
   * @param SupplierProduct $supplierProduct
   *
   * @return Response
   * @throws Exception
   */
  public function updateSupplierProduct(SupplierProduct $supplierProduct )
  {
    if ( empty( $supplierProduct->id ) )
    {
      throw new InvalidArgumentException( 'The "id" field is required' );
    }

    return $this->authorizedRequest( "supplier-products/{$supplierProduct->id}", $supplierProduct->toJson(), Sdk::METHOD_PUT );
  }

    /**
     * @param $supplierId
     * @param Warehouse $warehouse
     * @return Response
     */
  public function createWarehouse($supplierId, Warehouse $warehouse){
      return $this->authorizedRequest("{$this->endpoint}/{$supplierId}/warehouses", $warehouse->toJson(), Sdk::METHOD_POST);
  }

    /**
     * Delete a supplier by id
     *
     * @param int $id
     *
     * @return Response
     * @throws Exception
     */
    public function delete( int $id )
    {
        return $this->authorizedRequest( $this->endpoint . '/' . $id, null, self::METHOD_DELETE );
    }

}