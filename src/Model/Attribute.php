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
 * @property AttributeValue[] $option_values
 *
 * @property bool $has_options
 * @property int $sort_order
 */
class Attribute extends Model
{
  /**
   * Attribute types
   */
  const TYPE_STRING   = 'string';
  const TYPE_LONGTEXT = 'longtext';
  const TYPE_DATE     = 'date';
  const TYPE_DATETIME = 'datetime';
  const TYPE_NUMERIC  = 'numeric';
  const TYPE_INTEGER  = 'integer';
  const TYPE_CHECKBOX = 'checkbox';
  const TYPES         = [
    self::TYPE_STRING,
    self::TYPE_LONGTEXT,
    self::TYPE_DATE,
    self::TYPE_DATETIME,
    self::TYPE_NUMERIC,
    self::TYPE_INTEGER,
    self::TYPE_CHECKBOX,
  ];
  
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

  /**
   * Add attribute value
   *
   * @param string $value
   * @param int|null $sortOrder
   *
   * @return $this
   */
  public function addValue( string $value, int $sortOrder = null )
  {
    if ( ! isset( $this->option_values ) )
    {
      $this->option_values = [];
    }

    $this->option_values[] = [ 'value' => $value, 'sort_order' => $sortOrder ];

    return $this;
  }

  /**
   * Add attribute value
   *
   * @param AttributeValue $attributeValue
   *
   * @return $this
   */
  public function addAttributeValue( AttributeValue $attributeValue )
  {
    if ( ! isset( $this->option_values ) )
    {
      $this->option_values = [];
    }

    $this->option_values[] = $attributeValue;

    return $this;
  }
}