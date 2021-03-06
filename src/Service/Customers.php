<?php

namespace Skuio\Sdk\Service;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\DataType\Address;
use Skuio\Sdk\Query;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class Customers extends Sdk
{

  protected $endpoint = 'customers';

  /**
   * get all customers with filtering parameters
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
   * create new customer
   *
   * @param Address $address
   *
   * @return Response
   * @throws Exception
   */
  public function store( Address $address )
  {
    return $this->authorizedRequest( $this->endpoint, $address->toJson(), self::METHOD_POST );
  }

  /**
   * update customer by id
   *
   * @param Address $address
   * @param int $customer_id
   *
   * @return Response
   * @throws Exception
   *
   */
  public function update( Address $address, int $customer_id )
  {
    if ( is_null( $customer_id ) or ! isset( $customer_id ) )
    {
      throw new InvalidArgumentException( 'The "customer id" parameter is required' );
    }

    return $this->authorizedRequest( $this->endpoint . '/' . $customer_id, $address->toJson(), self::METHOD_PUT );
  }

  /**
   * @param string $name
   * @param string $zip
   * @param string $address1
   *
   * @return Response
   * @throws Exception
   */
  public function findMatch( string $name, string $zip, string $address1 )
  {
    if ( is_null( $name ) or is_null( $zip ) or is_null( $address1 ) )
    {
      throw new InvalidArgumentException( 'The "name, zip code and address1 fields are required' );

    }

    return $this->authorizedRequest( $this->endpoint . '/find-match?name=' . urlencode( $name ) . '&zip=' . urlencode( $zip ) . '&address1=' . urlencode( $address1 ) );

  }

}