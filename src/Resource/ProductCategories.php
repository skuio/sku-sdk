<?php

namespace Skuio\Sdk\Resource;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\Model\ProductCategory;
use Skuio\Sdk\Model\ProductToCategory;
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
   * @param ProductCategory $category
   *
   * @return Response
   * @throws Exception
   */
  public function store( ProductCategory $category )
  {
    return $this->authorizedRequest( $this->endpoint, $category->toJson(), self::METHOD_POST );
  }

  /**
   * Update a category
   *
   * @param ProductCategory $category
   *
   * @return Response
   * @throws Exception
   */
  public function update( ProductCategory $category )
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
   * @param ProductToCategory $productToCategory
   *
   * @return Response
   * @throws Exception
   */
  public function assignToProduct( ProductToCategory $productToCategory )
  {
    if ( empty( $productToCategory->product_id ) || empty( $productToCategory->category_id ) )
    {
      throw new InvalidArgumentException( "The product_id and category_id are required" );
    }

    return $this->authorizedRequest( "{$this->endpoint}/assign-category-to-product", $productToCategory->toJson(), self::METHOD_POST );
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
    return $this->authorizedRequest( "{$this->endpoint}/{$oldCategoryId}/reassign-to-products/{$newCategoryId}", null, self::METHOD_PUT );
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
    return $this->authorizedRequest( "{$this->endpoint}/for-manage?parent_id=$parentId" );
  }

  /**
   * Get Product Categories tree
   *
   * @return Response
   * @throws Exception
   */
  public function productCategoriesTree()
  {
    return $this->authorizedRequest( "{$this->endpoint}/tree" );
  }

  /**
   * Archive Category
   *
   * @param int $categoryId
   *
   * @return Response
   * @throws Exception
   */
  public function archive( int $categoryId )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$categoryId}/archive", null, self::METHOD_PUT );
  }

  /**
   * unarchived Category
   *
   * @param int $categoryId
   *
   * @return Response
   * @throws Exception
   */
  public function unarchived( int $categoryId )
  {
    return $this->authorizedRequest( "{$this->endpoint}/{$categoryId}/unarchived", null, self::METHOD_PUT );
  }
}