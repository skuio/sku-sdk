<?php

namespace Skuio\Sdk\DataType;

use InvalidArgumentException;
use Skuio\Sdk\DataType;

/**
 * Class NominalCode
 *
 * @package Skuio\Sdk\DataType
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $type
 */
class NominalCode extends DataType
{
  /**
   * Nominal Code types
   */
  const TYPE_REVENUE   = 'Revenue';
  const TYPE_EXPENSE   = 'Expense';
  const TYPE_ASSET     = 'Asset';
  const TYPE_LIABILITY = 'Liability';
  const TYPE_EQUITY    = 'Equity';
  const TYPES          = [
    self::TYPE_REVENUE,
    self::TYPE_EXPENSE,
    self::TYPE_ASSET,
    self::TYPE_LIABILITY,
    self::TYPE_EQUITY,
  ];

  public function __set( $name, $value )
  {
    if ( $name == 'type' && ! in_array( $value, self::TYPES ) )
    {
      throw new InvalidArgumentException( 'The nominal code type field must be one of ' . implode( ',', self::TYPES ) );
    }

    $this->$name = $value;
  }
}