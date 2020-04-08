<?php

namespace Skuio\Sdk\Resource;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\Model\Import;
use Skuio\Sdk\Model\SalesOrder;
use Skuio\Sdk\Request;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class SalesOrders extends Sdk
{
  protected $endpoint = 'sales-orders';

  /**
   * Retrieve sale orders
   *
   * @param Request $request
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
    return $this->authorizedRequest( $this->endpoint, $salesOrder->toJson(), self::METHOD_POST );
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

  public function archive( int $id  )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$id}/archive", null, self::METHOD_PUT );

  }

  public function unarchived( int $id  )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$id}/unarchived", null, self::METHOD_PUT );

  }
}