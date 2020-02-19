<?php

namespace Skuio\Sdk\Resource;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\Model\Currency;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class Currencies extends Sdk
{
  protected $endpoint = 'currencies';

  /**
   * Retrieve all currencies
   *
   * @return Response
   * @throws Exception
   */
  public function get()
  {
    return $this->authorizedRequest( $this->endpoint );
  }

  /**
   * Create a new currency
   *
   * @param Currency $currency
   *
   * @return Response
   * @throws Exception
   */
  public function store( Currency $currency )
  {
    return $this->authorizedRequest( $this->endpoint, $currency->toJson(), self::METHOD_POST );
  }

  /**
   * Update a currency
   *
   * @param Currency $currency
   *
   * @return Response
   * @throws Exception
   */
  public function update( Currency $currency )
  {
    if ( empty( $currency->id ) )
    {
      throw new InvalidArgumentException( 'The id field is required' );
    }

    return $this->authorizedRequest( "{$this->endpoint}/{$currency->id}", $currency->toJson(), self::METHOD_PUT );
  }

  /**
   * Delete a currency
   *
   * @param int $id
   *
   * @return Response
   * @throws Exception
   */
  public function delete( int $id )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$id}", null, self::METHOD_DELETE );
  }

  /**
   * Set a currency as default currency
   *
   * @param int $id
   *
   * @return Response
   * @throws Exception
   */
  public function setAsDefault( int $id )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$id}/set-default", null, self::METHOD_PUT );
  }
}