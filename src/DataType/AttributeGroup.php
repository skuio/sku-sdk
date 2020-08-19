<?php

namespace Skuio\Sdk\DataType;

use Skuio\Sdk\DataType;

/**
 * Class Attribute
 *
 * @package Skuio\Sdk\DataType
 *
 * @property int $id
 * @property string $name
 * @property int|null $parent_id
 * @property int[]|null $attributes
 */
class AttributeGroup extends DataType
{
  /**
   * Set/Add attributes by id
   *
   * @param int|array $attributes
   *
   * @return AttributeGroup
   */
  public function setAttributes( $attributes )
  {
    if ( ! isset( $this->attributes ) )
    {
      $this->attributes = [];
    }

    $this->attributes = array_unique( array_merge( $this->attributes, is_array( $attributes ) ? $attributes : [ $attributes ] ) );

    return $this;
  }
}