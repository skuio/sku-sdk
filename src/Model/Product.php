<?php

namespace Skuio\Sdk\Model;

use Skuio\Sdk\Model;

/**
 * Class Product
 *
 * @package Skuio\Sdk\Model
 *
 * @property int $id - sku.io id
 * @property int $parent_id - parent sku.io id
 * @property string $sku
 * @property string $barcode
 * @property string $brand_name
 * @property string $type
 * @property float $weight
 * @property string $weight_unit - lb,kg,oz
 * @property float $length
 * @property float $width
 * @property float $height
 * @property string $dimension_unit - in,cm
 * @property string $name
 * @property string $description
 * @property string $image
 * @property bool $download_image - store image on the server if you sent image url.
 * @property string[] $tags
 *
 * Pricing
 * @property ProductPricing[] $pricing
 *
 * Source
 * @property VendorProduct[] $vendors
 *
 * Taxonomy
 * @property ProductCategory[] $categories
 * @property int[] $attribute_groups
 * @property ProductAttribute[] $attributes
 *
 * @property Product[] $variations
 */
class Product extends Model
{
  /**
   * Product Types
   */
  const TYPE_STANDARD  = 'standard';
  const TYPE_BUNDLE    = 'bundle';
  const TYPE_VIRTUAL   = 'virtual';
  const TYPE_BLEMISHED = 'blemished';
  const TYPES          = [ self::TYPE_STANDARD, self::TYPE_BUNDLE, self::TYPE_VIRTUAL, self::TYPE_BLEMISHED ];

  /**
   * Product weight units
   */
  const WEIGHT_UNIT_LB = 'lb';
  const WEIGHT_UNIT_KG = 'kg';
  const WEIGHT_UNIT_OZ = 'oz';
  const WEIGHT_UNITS   = [ self::WEIGHT_UNIT_LB, self::WEIGHT_UNIT_KG, self::WEIGHT_UNIT_OZ ];

  /**
   * Product dimension units
   */
  const DIMENSION_UNIT_INCH = 'in';
  const DIMENSION_UNIT_CM   = 'cm';
  const DIMENSION_UNITS     = [ self::DIMENSION_UNIT_INCH, self::DIMENSION_UNIT_CM ];
}