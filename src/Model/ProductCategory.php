<?php

namespace Skuio\Sdk\Model;

use Skuio\Sdk\Model;

/**
 * Class ProductCategory
 *
 * @package Skuio\Sdk\Model
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $name
 * @property int[]|null $attribute_groups
 */
class ProductCategory extends Model
{
  /**
   * Set/Add attribute groups by id
   *
   * @param int|array $attributeGroups
   *
   * @return ProductCategory
   */
  public function setAttributeGroups( $attributeGroups )
  {
    if ( ! isset( $this->attribute_groups ) )
    {
      $this->attribute_groups = [];
    }

    $this->attribute_groups = array_unique( array_merge( $this->attribute_groups, is_array( $attributeGroups ) ? $attributeGroups : [ $attributeGroups ] ) );

    return $this;
  }
}