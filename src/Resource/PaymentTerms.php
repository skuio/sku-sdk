<?php

namespace Skuio\Sdk\Resource;

use Exception;
use Skuio\Sdk\Request;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class PaymentTerms extends Sdk
{
  protected $endpoint = 'payment-terms';

  /**
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
   * @param int $id
   * @param Request|null $request
   *
   * @return Response
   * @throws Exception
   */
  public function show( int $id, Request $request = null )
  {
    if ( ! $request )
    {
      $request = new Request();
    }

    return $this->authorizedRequest( "{$this->endpoint}/{$id}?{$request->getParams()}" );
  }

  /**
   * @param string $paymentTermName
   *
   * @return Response
   * @throws Exception
   */
  public function store( string $paymentTermName )
  {
    return $this->authorizedRequest( $this->endpoint, json_encode( [ 'name' => $paymentTermName ] ), Sdk::METHOD_POST );
  }

  /**
   * @param int $id
   * @param string $paymentTermName
   *
   * @return Response
   * @throws Exception
   */
  public function update( int $id, string $paymentTermName )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$id}", json_encode( [ 'name' => $paymentTermName ] ), Sdk::METHOD_PUT );
  }

  /**
   * @param int $id
   *
   * @return Response
   * @throws Exception
   */
  public function archive( int $id )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$id}/archive" );
  }

  /**
   * @param int $id
   *
   * @return Response
   * @throws Exception
   */
  public function unarchived( int $id )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$id}/unarchived" );
  }
}