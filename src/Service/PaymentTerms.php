<?php

namespace Skuio\Sdk\Service;

use Exception;
use Skuio\Sdk\Query;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class PaymentTerms extends Sdk
{
  protected $endpoint = 'payment-terms';

  /**
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
   * @param int $id
   * @param Query|null $request
   *
   * @return Response
   * @throws Exception
   */
  public function show(int $id, Query $request = null )
  {
    if ( ! $request )
    {
      $request = new Query();
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
}