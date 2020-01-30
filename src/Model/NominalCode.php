<?php

namespace Skuio\Sdk\Model;

use Skuio\Sdk\Model;

/**
 * Class NominalCode
 *
 * @package Skuio\Sdk\Model
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $type
 */
class NominalCode extends Model
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
}