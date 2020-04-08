<?php

namespace Skuio\Sdk\Resource;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\Model\Warehouse;
use Skuio\Sdk\Model\WarehouseLocation;
use Skuio\Sdk\Request;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class Warehouses extends Sdk
{
  protected $endpoint = 'warehouses';

  /**
   * Retrieve a list of warehouses
   *
   * @param Request|null $request
   *
   * @return Response
   * @throws Exception
   */
  public function get( Request $request = null )
  {
    if ( ! $request )
    {
      $request = new Request();
    }

    return $this->authorizedRequest( $this->endpoint . '?' . $request->getParams() );
  }

  /**
   * create new warehouse
   *
   * @param Warehouse $warehouse
   *
   * @return Response
   * @throws Exception
   */
  public function store( Warehouse $warehouse )
  {
    return $this->authorizedRequest( $this->endpoint, $warehouse->toJson(), Sdk::METHOD_POST );
  }

  /**
   * @param Warehouse $warehouse
   *
   * @return Response
   * @throws Exception
   */
  public function update( Warehouse $warehouse )
  {
    if ( empty( $warehouse->id ) )
    {
      throw new InvalidArgumentException( 'The id field is required.' );
    }

    return $this->authorizedRequest( "{$this->endpoint}/{$warehouse->id}", $warehouse->toJson(), Sdk::METHOD_PUT );
  }

  /**
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
   * @param WarehouseLocation $warehouseLocation
   *
   * @return Response
   * @throws Exception
   */
  public function storeLocation( WarehouseLocation $warehouseLocation )
  {
    return $this->authorizedRequest( 'warehouse-locations', $warehouseLocation->toJson(), Sdk::METHOD_POST );
  }

  /**
   * @param WarehouseLocation $warehouseLocation
   *
   * @return Response
   * @throws Exception
   */
  public function updateLocation( WarehouseLocation $warehouseLocation )
  {
    if ( empty( $warehouseLocation->id ) )
    {
      throw new InvalidArgumentException( 'The id field is required.' );
    }

    return $this->authorizedRequest( "warehouse-locations/{$warehouseLocation->id}", $warehouseLocation->toJson(), Sdk::METHOD_PUT );
  }
}