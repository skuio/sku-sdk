<?php

namespace Skuio\Sdk\Model;

use InvalidArgumentException;
use Skuio\Sdk\Model;

/**
 * Class Warehouse
 *
 * @package Skuio\Sdk\Model
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $email
 * @property string $phone
 */
class Warehouse extends Model
{
  /**
   * Warehouse Types
   */
  const TYPE_DIRECT   = 'direct';
  const TYPE_3PL      = '3pl';
  const TYPE_SUPPLIER = 'supplier';
  const TYPE_VENDOR = 'vendor';
  const TYPES         = [
    self::TYPE_DIRECT,
    self::TYPE_3PL,
    self::TYPE_SUPPLIER,
    self::TYPE_VENDOR,
  ];

  public function __set( $name, $value )
  {
    if ( $name == 'type' && ! in_array( $value, self::TYPES ) )
    {
      throw new InvalidArgumentException( 'The warehouse type field must be one of ' . implode( ',', self::TYPES ) );
    }

    $this->$name = $value;
  }
}