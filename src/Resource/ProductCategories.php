<?php

namespace Skuio\Sdk\Resource;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\Model\Category;
use Skuio\Sdk\Request;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class ProductCategories extends Sdk
{
  protected $endpoint = 'categories';

  /**
   * Retrieve product categories according to your request
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
   * Get product category by id
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
   * Create a new category
   *
   * @param Category $category
   *
   * @return Response
   * @throws Exception
   */
  public function store( Category $category )
  {
    return $this->authorizedRequest( $this->endpoint, $category->toJson(), self::METHOD_POST );
  }

  /**
   * Update a category
   *
   * @param Category $category
   *
   * @return Response
   * @throws Exception
   */
  public function update( Category $category )
  {
    if ( empty( $category->id ) )
    {
      throw new InvalidArgumentException( 'The "id" field is required' );
    }

    return $this->authorizedRequest( $this->endpoint . '/' . $category->id, $category->toJson(), self::METHOD_PUT );
  }

  /**
   * Delete a category
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
   * Assign Category to Product
   *
   * @param int $categoryId
   * @param int $productId
   * @param bool $isPrimaryCategory
   *
   * @return Response
   * @throws Exception
   */
  public function assignToProduct( int $categoryId, int $productId, bool $isPrimaryCategory = false )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$categoryId}/assign-to-product/{$productId}?is_primary=".($isPrimaryCategory?1:0), null, self::METHOD_GET );
  }

  /**
   * Reassigning new category to products
   *
   * @param int $oldCategoryId
   * @param int $newCategoryId
   *
   * @return Response
   * @throws Exception
   */
  public function reassignNewCategoryToProducts( int $oldCategoryId, int $newCategoryId )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$oldCategoryId}/reassign-to-products/{$newCategoryId}", null, self::METHOD_GET );
  }

  /**
   * Retrieve Product Categories for manage (in edit product when assign)
   *
   * @param int|null $parentId
   *
   * @return Response
   * @throws Exception
   */
  public function getProductCategoriesForManage( int $parentId = null )
  {
    return $this->authorizedRequest( "{$this->endpoint}/for-manage?parent_id=$parentId", null, self::METHOD_GET );
  }

  /**
   * Get Product Categories tree
   *
   * @return Response
   * @throws Exception
   */
  public function productCategoriesTree()
  {
    return $this->authorizedRequest( "{$this->endpoint}/tree", null, self::METHOD_GET );
  }

  /**
   * Archive Category
   *
   * @param int $categoryId
   *
   * @return Response
   * @throws Exception
   */
  public function archiveCategory(int $categoryId)
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$categoryId}/archive", null, self::METHOD_GET );
  }

  /**
   * Un-archive Category
   *
   * @param int $categoryId
   *
   * @return Response
   * @throws Exception
   */
  public function unArchiveCategory(int $categoryId)
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$categoryId}/unarchived", null, self::METHOD_GET );
  }
}