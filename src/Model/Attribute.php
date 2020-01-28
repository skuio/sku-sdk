<?php

namespace Skuio\Sdk\Model;

use Skuio\Sdk\Model;

/**
 * Class Attribute
 *
 * @package Skuio\Sdk\Model
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property array $display_options
 * @property array $validation
 * @property string $archived_at
 * @property AttributeValue[] $option_values
 *
 * @property bool $has_options
 * @property int $sort_order
 */
class Attribute extends Model
{
  public function __set( $name, $value )
  {
    if ( $name == 'has_options' || $name == 'sort_order' )
    {
      if ( ! isset( $this->display_options ) )
      {
        $this->display_options = [];
      }

      $this->display_options[ $name ] = $value;
    } else
    {
      $this->$name = $value;
    }
  }
}