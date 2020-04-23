<?php

namespace Skuio\Sdk\Resource;

use Skuio\Sdk\Model\Address;
use Skuio\Sdk\Model\Product;
use Skuio\Sdk\Request;
use Skuio\Sdk\Sdk;
use Exception;
use InvalidArgumentException;
use Skuio\Sdk\Response;
use function Couchbase\defaultDecoder;

class Customers extends Sdk
{

  protected $endpoint = 'customers';

  /**
   * get all customers with filtering parameters
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