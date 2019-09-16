<?php

namespace Skuio\Sdk\Model;

use Rakit\Validation\Validator;
use Skuio\Sdk\Model;
use Skuio\Sdk\ValidationException;

/**
 * Class Product
 *
 * @package Skuio\Sdk\Resources
 *
 * @property int $id - sku.io id
 * @property int $parent_id - parent sku.io id
 * @property string $sku
 * @property array $gtin
 * @property string $brand_name
 * @property string $type
 * @property float $weight
 * @property string $weight_unit - lb,kg,oz
 * @property float $length
 * @property float $width
 * @property float $height
 * @property string $dimension_unit - in,cm
 * @property string $name
 * @property string $image
 * @property bool $download_image - store image on the server if you sent image url.
 * @property string $description
 * @property Attribute[] $attributes
 * @property string[] $tags
 * @property Variation[] $variations
 */
class Product extends Model
{
}