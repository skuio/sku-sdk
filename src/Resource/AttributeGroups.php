<?php

namespace Skuio\Sdk\Resource;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\Model\AttributeGroup;
use Skuio\Sdk\Request;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class AttributeGroups extends Sdk
{
  protected $endpoint = 'attribute-groups';

  /**
   * Retrieve a list of attribute groups
   *
   * @param int|null $parentId
   * @param Request|null $request
   *
   * @return Response
   * @throws Exception
   */
  public function get( int $parentId = null, Request $request = null )
  {
    if ( ! $request )
    {
      $request = new Request();
    }

    return $this->authorizedRequest( $this->endpoint . "?parent_id={$parentId}&" . $request->getParams() );
  }

  /**
   * Get attribute group by id
   *
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
   * Create a new attribute group
   *
   * @param AttributeGroup $attributeGroup
   *
   * @return Response
   * @throws Exception
   */
  public function store( AttributeGroup $attributeGroup )
  {
    return $this->authorizedRequest( $this->endpoint, $attributeGroup->toJson(), self::METHOD_POST );
  }

  /**
   * Update an attribute group
   *
   * @param AttributeGroup $attributeGroup
   *
   * @return Response
   * @throws Exception
   */
  public function update( AttributeGroup $attributeGroup )
  {
    if ( empty( $attributeGroup->id ) )
    {
      throw new InvalidArgumentException( 'The "id" field is required' );
    }

    return $this->authorizedRequest( "{$this->endpoint}/{$attributeGroup->id}", $attributeGroup->toJson(), self::METHOD_PUT );
  }

  /**
   * Delete an attribute group
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
}