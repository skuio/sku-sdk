<?php

namespace Skuio\Sdk\Resource;

use Skuio\Sdk\Model\Attribute;
use Skuio\Sdk\Request;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class Attributes extends Sdk
{
  protected $endpoint = 'attributes';

  /**
   * Retrieve attributes according to your request
   *
   * @param Request $request
   *
   * @return Response
   */
  public function get( Request $request )
  {
    return $this->authorizedRequest( $this->endpoint . '?' . $request->getParams() );
  }

  /**
   * Update or create a new attribute
   *
   * @param Attribute $attribute
   *
   * @return Response
   */
  public function store( Attribute $attribute )
  {
    return $this->authorizedRequest( $this->endpoint, $attribute->toJson(), self::METHOD_POST );
  }

  /**
   * Delete an attribute
   *
   * @param $id
   *
   * @return Response
   */
  public function delete( $id )
  {
    return $this->authorizedRequest( $this->endpoint . '/' . $id, null, self::METHOD_DELETE );
  }
}