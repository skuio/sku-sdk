<?php

namespace Skuio\Sdk\Model;

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
  const TYPES         = [
    self::TYPE_DIRECT,
    self::TYPE_3PL,
    self::TYPE_SUPPLIER,
  ];
}