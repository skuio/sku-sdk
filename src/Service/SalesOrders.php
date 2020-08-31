<?php

namespace Skuio\Sdk\Service;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\DataType\Import;
use Skuio\Sdk\DataType\SalesOrder;
use Skuio\Sdk\DataType\SalesOrderFulfillment;
use Skuio\Sdk\Query;
use Skuio\Sdk\Request\FulfillSalesOrderRequest;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class SalesOrders extends Sdk
{
  protected $endpoint = 'sales-orders';

  /**
   * Retrieve sale orders
   *
   * @param Query $request
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
   * Retrieve a sales order by id
   *
   * @param int $id
   *
   * @return Response
   * @throws Exception
   */
  public function show( int $id )
  {
    return $this->authorizedRequest( $this->endpoint . '/' . $id );
  }

  /**
   * Create a new sales order
   *
   * @param SalesOrder $salesOrder
   *
   * @return Response
   * @throws Exception
   */
  public function store( SalesOrder $salesOrder )
  {
    return $this->afterStore(
        $salesOrder,
        $this->authorizedRequest( $this->endpoint, $salesOrder->toJson(), self::METHOD_POST )
    );
  }

  /**
   * Update a sales order by id
   *
   * @param SalesOrder $salesOrder
   *
   * @return Response
   * @throws Exception
   */
  public function update( SalesOrder $salesOrder )
  {
    if ( empty( $salesOrder->id ) )
    {
      throw new InvalidArgumentException( 'The "id" field is required' );
    }

    return $this->authorizedRequest( $this->endpoint . '/' . $salesOrder->id, $salesOrder->toJson(), self::METHOD_PUT );
  }

  /**
   * Delete a sales order by id
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

  /**
   * Import sales orders from a CSV file
   *
   * @param Import $import
   *
   * @return Response
   * @throws Exception
   */
  public function import( Import $import )
  {
    if ( empty( $import->csv_file ) )
    {
      throw new InvalidArgumentException( 'The csv_file field is required' );
    }

    return $this->authorizedRequest( $this->endpoint . '/import', $import->toArray(), self::METHOD_POST );
  }

  /**
   * Retrieve sales order constants data
   *
   * @return Response
   * @throws Exception
   */
  public function constants()
  {
    return $this->authorizedRequest( $this->endpoint . '/constants' );
  }

  /**
   * Archive sales order
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
   * Unarchived sales order
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
   * Bulk archive sales orders
   *
   * @param Query|null $filters
   * @param array|null $salesOrdersIds
   *
   * @return Response
   * @throws Exception
   */
  public function bulkArchive(Query $filters = null, array $salesOrdersIds = null )
  {
    return $this->bulkOperation( "{$this->endpoint}/archive", self::METHOD_PUT, $filters, $salesOrdersIds );
  }

  /**
   * Bulk un archive sales orders
   *
   * @param Query|null $filters
   * @param array|null $salesOrdersIds
   *
   * @return Response
   * @throws Exception
   */
  public function bulkunArchive(Query $filters = null, array $salesOrdersIds = null )
  {
    return $this->bulkOperation( "{$this->endpoint}/unarchive", self::METHOD_PUT, $filters, $salesOrdersIds );
  }

  /**
   * Bulk delete sales orders
   *
   * @param Query|null $filters
   * @param array|null $salesOrdersIds
   *
   * @return Response
   * @throws Exception
   */
  public function bulkDelete(Query $filters = null, array $salesOrdersIds = null )
  {
    return $this->bulkOperation( $this->endpoint, self::METHOD_DELETE, $filters, $salesOrdersIds );
  }

  /**
   * Fulfill sales order
   *
   * @param SalesOrderFulfillment $orderFulfillment
   *
   * @return Response
   * @throws Exception
   */
  public function fulfill( SalesOrderFulfillment $orderFulfillment )
  {
    if ( empty( $orderFulfillment->sales_order_id ) )
    {
      throw new InvalidArgumentException( 'The "sales_order_id" field is required' );
    }

    return $this->authorizedRequest( "{$this->endpoint}/{$orderFulfillment->sales_order_id}/fulfill", $orderFulfillment->toJson(), self::METHOD_POST );
  }

  /**
   * Bulk operation
   *
   * @param string $endpoint
   * @param string $method
   * @param Query|null $filters
   * @param array|null $salesOrdersIds
   *
   * @return Response
   * @throws Exception
   */
  private function bulkOperation(string $endpoint, string $method, Query $filters = null, array $salesOrdersIds = null )
  {
    if ( ( $filters && ! empty( $salesOrdersIds ) ) || ( ! $filters && empty( $salesOrdersIds ) ) )
    {
      throw new InvalidArgumentException( 'You must specify either filters or salesOrdersIds parameters, but not both.' );
    }

    // bulk operation by request filters
    if ( $filters )
    {
      if ( empty( $filters->toArray()['filters'] ) )
      {
        throw new InvalidArgumentException( 'You must specify filters in request' );
      }

      return $this->authorizedRequest( $endpoint . '?' . $filters->getParams(), null, $method );
    }

    // bulk operation by salesOrdersIds ids
    return $this->authorizedRequest( $endpoint, json_encode( [ 'ids' => $salesOrdersIds ] ), $method );
  }

}