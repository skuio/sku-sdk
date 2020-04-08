<?php

namespace Skuio\Sdk\Model;

use Skuio\Sdk\Model;

/**
 * Class Setting
 * @package Skuio\Sdk\Model
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $key
 * @property string|null $description
 * @property string $type
 * @property string|null $value
 * @property string|null $default_value
 */
class Setting extends Model
{

  /**
   * Setting Types
   */
  const TYPE_STRING   = 'string';
  const TYPE_DATE     = 'date';
  const TYPE_CHECKBOX = 'checkbox';
  const TYPE_INTEGER  = 'integer';



}