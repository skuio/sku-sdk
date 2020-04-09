<?php

namespace Skuio\Sdk\Resource;

use Exception;
use Skuio\Sdk\Model\SalesChannelBrand;
use Skuio\Sdk\Request;
use Skuio\Sdk\Sdk;
use Skuio\Sdk\Response;
use InvalidArgumentException;

class SalesChannelBrands extends Sdk
{

  protected $endpoint = 'sales-channel-brands';

  /**
   * Retrieve all sales channel brands
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
   * Retrieve a sales channel brand by id
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
   * Create a new sales channel brand
   *
   * @param SalesChannelBrand $salesChannelBrand
   *
   * @return Response
   * @throws Exception
   */
  public function store( SalesChannelBrand $salesChannelBrand )
  {
    return $this->authorizedRequest( $this->endpoint, $salesChannelBrand->toJson(), self::METHOD_POST );
  }

  /**
   * Update sales channel brand by id
   *
   * @param SalesChannelBrand $salesChannelBrand
   *
   * @return Response
   * @throws Exception
   */
  public function update( SalesChannelBrand $salesChannelBrand )
  {
    if ( empty( $salesChannelBrand->id ) )
    {
      throw new InvalidArgumentException( 'The "id" field is required' );
    }

    return $this->authorizedRequest( $this->endpoint . '/' . $salesChannelBrand->id, $salesChannelBrand->toJson(), self::METHOD_PUT );
  }

}