<?php

namespace Skuio\Sdk;

use Skuio\Sdk\Support\Arrayable;
use Skuio\Sdk\Support\Jsonable;


/**
 * Class DataType
 * @package Skuio\Sdk
 *
 * @property int|null id
 */
abstract class DataType
{

    use Arrayable, Jsonable;

  /**
   * Operations
   */
  // for array of objects
  const OPERATION_ADD     = 'updateOrCreate';
  const OPERATION_REPLACE = 'updateOrCreate';
  const OPERATION_DELETE  = 'delete';

  public function __construct( array $attributes = null )
  {
    foreach ( $attributes ?: [] as $key => $value )
    {
      $this->$key = $value;
    }
  }
}