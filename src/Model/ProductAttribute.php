<?php

namespace Skuio\Sdk\Model;

use Skuio\Sdk\Model;

/**
 * Class Attribute
 *
 * @package Skuio\Sdk\Model
 *
 * @property string $name
 * @property string $type
 * @property bool $has_options
 * @property mixed $value
 */
class ProductAttribute extends Model
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
}