<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 7/24/20
 * Time: 9:06 AM
 */

namespace Skuio\Sdk\Resource;


use Skuio\Sdk\Model\Import;
use Skuio\Sdk\Model\PurchaseOrder;
use Skuio\Sdk\Model\PurchaseOrderInvoice;
use Skuio\Sdk\Model\PurchaseOrderShipment;
use Skuio\Sdk\Request;
use Skuio\Sdk\Response;
use Exception;
use InvalidArgumentException;
use Skuio\Sdk\Sdk;
use Skuio\Sdk\Model\PurchaseOrderReceipt;

/**
 * Class PurchaseOrders
 * @package Skuio\Sdk\Resource
 */
class PurchaseOrders extends Sdk
{

    protected $endpoint = 'purchase-orders';

    /**
     * Retrieve purchase orders
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
     * Retrieve a purchase order by id
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
     * Create a new purchase order
     *
     * @param PurchaseOrder $purchaseOrder
     *
     * @return Response
     * @throws Exception
     */
    public function store( PurchaseOrder $purchaseOrder )
    {
        return $this->authorizedRequest( $this->endpoint, $purchaseOrder->toJson(), self::METHOD_POST );
    }

    /**
     * Update a purchase order by id
     *
     * @param PurchaseOrder $purchaseOrder
     *
     * @return Response
     * @throws Exception
     */
    public function update( PurchaseOrder $purchaseOrder )
    {
        if ( empty( $purchaseOrder->id ) )
        {
            throw new InvalidArgumentException( 'The "id" field is required' );
        }

        return $this->authorizedRequest( $this->endpoint . '/' . $purchaseOrder->id, $purchaseOrder->toJson(), self::METHOD_PUT );
    }


    /**
     * Submits the purchase order
     *
     * @param PurchaseOrder $purchaseOrder
     * @return Response
     */
    public function submit( PurchaseOrder $purchaseOrder )
    {
        if ( empty( $purchaseOrder->id ) )
        {
            throw new InvalidArgumentException( 'The "id" field is required' );
        }

        return $this->authorizedRequest( $this->endpoint . '/' . $purchaseOrder->id . '/submit', $purchaseOrder->toJson(), self::METHOD_PUT );
    }


    /**
     * Delete a purchase order by id
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
     * Import purchase orders from a CSV file
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
     * Retrieve purchase order constants data
     *
     * @return Response
     * @throws Exception
     */
    public function constants()
    {
        return $this->authorizedRequest( $this->endpoint . '/constants' );
    }

    /**
     * Archive purchase order
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
     * Unarchived purchase order
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
     * Bulk archive purchase orders
     *
     * @param Request|null $filters
     * @param array|null $purchaseOrdersIds
     *
     * @return Response
     * @throws Exception
     */
    public function bulkArchive( Request $filters = null, array $purchaseOrdersIds = null )
    {
        return $this->bulkOperation( "{$this->endpoint}/archive", self::METHOD_PUT, $filters, $purchaseOrdersIds );
    }

    /**
     * Bulk un archive purchase orders
     *
     * @param Request|null $filters
     * @param array|null $purchaseOrdersIds
     *
     * @return Response
     * @throws Exception
     */
    public function bulkunArchive( Request $filters = null, array $purchaseOrdersIds = null )
    {
        return $this->bulkOperation( "{$this->endpoint}/unarchive", self::METHOD_PUT, $filters, $purchaseOrdersIds );
    }

    /**
     * Bulk delete purchase orders
     *
     * @param Request|null $filters
     * @param array|null $purchaseOrdersIds
     *
     * @return Response
     * @throws Exception
     */
    public function bulkDelete( Request $filters = null, array $purchaseOrdersIds = null )
    {
        return $this->bulkOperation( $this->endpoint, self::METHOD_DELETE, $filters, $purchaseOrdersIds );
    }

    /**
     * Bulk operation
     *
     * @param string $endpoint
     * @param string $method
     * @param Request|null $filters
     * @param array|null $purchaseOrdersIds
     *
     * @return Response
     * @throws Exception
     */
    private function bulkOperation( string $endpoint, string $method, Request $filters = null, array $purchaseOrdersIds = null )
    {
        if ( ( $filters && ! empty( $purchaseOrdersIds ) ) || ( ! $filters && empty( $purchaseOrdersIds ) ) )
        {
            throw new InvalidArgumentException( 'You must specify either filters or purchaseOrdersIds parameters, but not both.' );
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

        // bulk operation by purchaseOrdersIds ids
        return $this->authorizedRequest( $endpoint, json_encode( [ 'ids' => $purchaseOrdersIds ] ), $method );
    }




    /**
     * @param PurchaseOrderShipment $shipment
     * @return Response
     */
    public function createShipment(PurchaseOrderShipment $shipment )
    {
        if ( empty( $shipment->purchase_order_id ) )
        {
            throw new InvalidArgumentException( 'The "purchase order id" field is required.' );
        }else if(empty($shipment->shipment_date)) {
            throw new InvalidArgumentException( 'The "shipment date" field is required.' );
        }else if(empty($shipment->shipment_lines)){
            throw new InvalidArgumentException( 'The "shipment lines" field is required.' );
        }

        return $this->authorizedRequest( "purchase-order-shipments", $shipment->toJson(), self::METHOD_POST );
    }


    /**
     * @param PurchaseOrderReceipt $request
     * @return Response
     */
    public function receive(PurchaseOrderReceipt $request )
    {
        if ( empty( $request->purchase_order_shipment_id ) )
        {
            throw new InvalidArgumentException( 'The "purchase order shipment id" field is required.' );
        }else if(empty($request->received_at)) {
            throw new InvalidArgumentException( 'The "received at" field is required.' );
        }else if(empty($request->receipt_lines)){
            throw new InvalidArgumentException( 'The "receipt lines" field is required.' );
        }

        return $this->authorizedRequest( "purchase-order-shipments/receipt", $request->toJson(), self::METHOD_POST );
    }


    /**
     * @param PurchaseOrderInvoice $invoice
     * @return Response
     */
    public function invoice( PurchaseOrderInvoice $invoice )
    {
        if ( empty( $invoice->purchase_order_id ) )
        {
            throw new InvalidArgumentException( 'The "purchase order id" field is required.' );
        }else if(empty($invoice->purchase_invoice_date)) {
            throw new InvalidArgumentException( 'The "purchase invoice date" field is required.' );
        }else if(empty($invoice->supplier_invoice_number)){
            throw new InvalidArgumentException( 'The "supplier invoice number" field is required.' );
        }
        else if(empty($invoice->purchase_invoice_lines)){
            throw new InvalidArgumentException( 'The "purchase invoice lines" field is required.' );
        }

        return $this->authorizedRequest( "purchase-invoices", $invoice->toJson(), self::METHOD_POST );
    }




}