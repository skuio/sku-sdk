<?php

namespace Skuio\Sdk\DataType;

use InvalidArgumentException;
use Skuio\Sdk\DataType;

/**
 * Class Product
 *
 * @package Skuio\Sdk\DataType
 *
 * @property int $id - sku.io id
 * @property int $parent_id - parent sku.io id
 * @property string $sku
 * @property string $barcode
 * @property string $mpn
 * @property string $brand_name
 * @property string $type
 * @property float $weight
 * @property string $weight_unit - lb,kg,oz
 * @property float $length
 * @property float $width
 * @property float $height
 * @property string $dimension_unit - in,cm
 * @property string|null $fba_prep_instructions
 * @property float|null $case_quantity
 * @property float|null $case_length
 * @property float|null $case_width
 * @property float|null $case_height
 * @property string|null $case_dimension_unit
 * @property float|null $case_weight
 * @property string|null $case_weight_unit
 * @property string $name
 * @property ProductImage[] $images
 * @property string[] $tags
 * @property array $initial_inventory
 *
 * Pricing
 * @property ProductPricing[] $pricing
 *
 * Source
 * @property SupplierProduct[] $suppliers
 *
 * Taxonomy
 * @property ProductToCategory[] $categories
 * @property int[] $attribute_groups
 * @property ProductAttribute[] $attributes
 * @property array $components
 *
 * @property Product[] $variations
 */
class Product extends DataType
{
    // for arrays
    const OPERATION_SET = 'set';
    const OPERATION_APPEND = 'append';

    /**
     * Product Types
     */
    const TYPE_STANDARD = 'standard';
    const TYPE_BUNDLE = 'bundle';
    const TYPE_VIRTUAL = 'virtual';
    const TYPE_BLEMISHED = 'blemished';
    const TYPES = [self::TYPE_STANDARD, self::TYPE_BUNDLE, self::TYPE_VIRTUAL, self::TYPE_BLEMISHED];

    /**
     * Product weight units
     */
    const WEIGHT_UNIT_LB = 'lb';
    const WEIGHT_UNIT_KG = 'kg';
    const WEIGHT_UNIT_OZ = 'oz';
    const WEIGHT_UNITS = [self::WEIGHT_UNIT_LB, self::WEIGHT_UNIT_KG, self::WEIGHT_UNIT_OZ];

    /**
     * Product dimension units
     */
    const DIMENSION_UNIT_INCH = 'in';
    const DIMENSION_UNIT_CM = 'cm';
    const DIMENSION_UNITS = [self::DIMENSION_UNIT_INCH, self::DIMENSION_UNIT_CM];

    /**
     * Set brand name
     *
     * @param string $brandName
     *
     * @return $this
     */
    public function setBrand(string $brandName)
    {
        $this->brand_name = $brandName;

        return $this;
    }

    /**
     * Set product type
     *
     * @param string $type
     *
     * @return Product
     */
    public function setProductType(string $type)
    {
        if (!in_array($type, [self::TYPE_STANDARD, self::TYPE_VIRTUAL])) {
            throw new InvalidArgumentException('The type field must be ' . self::TYPE_STANDARD . ' or ' . self::TYPE_VIRTUAL);
        }

        $this->type = $type;

        return $this;
    }

    /**
     * Set weight unit
     *
     * @param string $weightUnit
     *
     * @return $this
     */
    public function setWeightUnit(string $weightUnit)
    {
        if (!in_array($weightUnit, self::WEIGHT_UNITS)) {
            throw new InvalidArgumentException('The weight_unit field must be one of ' . implode(',', self::WEIGHT_UNITS));
        }

        $this->weight_unit = $weightUnit;

        return $this;
    }

    /**
     * Set Dimension unit
     *
     * @param string $dimensionUnit
     *
     * @return $this
     */
    public function setDimensionUnit(string $dimensionUnit)
    {
        if (!in_array($dimensionUnit, self::DIMENSION_UNITS)) {
            throw new InvalidArgumentException('The dimension_unit field must be one of ' . implode(',', self::DIMENSION_UNITS));
        }

        $this->dimension_unit = $dimensionUnit;

        return $this;
    }

    /**
     * Set Primary image
     *
     * @param string $imageUrl
     * @param bool $downloadToServer
     *
     * @return $this
     */
    public function setPrimaryImage(string $imageUrl, bool $downloadToServer = false)
    {
        if (!isset($this->images)) {
            $this->images = [];
        }

        $this->images[] = ['url' => $imageUrl, 'is_primary' => true, 'download' => $downloadToServer];

        return $this;
    }

    /**
     * Set primary image
     *
     * @param ProductImage $productImage
     *
     * @return $this
     */
    public function setPrimaryProductImage(ProductImage $productImage)
    {
        if (!isset($this->images)) {
            $this->images = [];
        }
        $productImage->operation = self::OPERATION_ADD;
        // set as primary image
        $productImage->is_primary = true;

        $this->images[] = $productImage;

        return $this;
    }

    /**
     * Add image
     *
     * @param ProductImage $productImage
     * @param string $operation
     *
     * @return $this
     */
    public function addProductImage(ProductImage $productImage, $operation = self::OPERATION_ADD)
    {
        if (!isset($this->images)) {
            $this->images = [];
        }
        $productImage->operation = $operation;

        $this->images[] = $productImage;

        return $this;
    }

    /**
     * Delete image
     *
     * @param int $productImageId
     *
     * @return $this
     */
    public function deleteProductImage(int $productImageId)
    {
        if (!isset($this->images)) {
            $this->images = [];
        }

        $this->images[] = ['id' => $productImageId, 'operation' => self::OPERATION_DELETE];

        return $this;
    }

    /**
     * Set description attribute
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description)
    {
        if (!isset($this->attributes)) {
            $this->attributes = [];
        }

        $this->attributes[] = [
            'name' => 'description',
            'value' => $description,
            'operation' => self::OPERATION_ADD,
        ];

        return $this;
    }

    /**
     * Set tags to the product
     *
     * @param string|array $tags
     *
     * @return Product
     */
    public function setTags($tags)
    {
        $this->tags = is_array($tags) ? $tags : [$tags];
        $this->tags_operation = self::OPERATION_SET;

        return $this;
    }

    /**
     * Add tags to the product
     *
     * @param string|array $tags
     *
     * @return Product
     */
    public function addTags($tags)
    {
        if (!isset($this->tags)) {
            $this->tags = [];
        }

        $this->tags = array_unique(array_merge($this->tags, is_array($tags) ? $tags : [$tags]));
        $this->tags_operation = isset($this->tags_operation) ? ($this->tags_operation == self::OPERATION_SET ? $this->tags_operation : self::OPERATION_APPEND) : self::OPERATION_APPEND;

        return $this;
    }

    /**
     * Delete tags from product
     *
     * @param string|array $tags
     *
     * @return Product
     */
    public function deleteTags($tags)
    {
        $this->tags = is_array($tags) ? $tags : [$tags];
        $this->tags_operation = self::OPERATION_DELETE;

        return $this;
    }

    /**
     * Add pricing
     *
     * @param ProductPricing $pricing
     * @param string $operation
     *
     * @return $this
     */
    public function addPrice(ProductPricing $pricing, string $operation = self::OPERATION_ADD)
    {
        if (!isset($this->pricing)) {
            $this->pricing = [];
        }
        $pricing->operation = $operation;

        $this->pricing[] = $pricing;

        return $this;
    }

    /**
     * Replace All prices
     *
     * @param ProductPricing|ProductPricing[] $prices
     *
     * @return $this
     */
    public function replaceAllPrices($prices)
    {
        $prices = is_array($prices) ? $prices : [$prices];
        // unset operation property from suppliers
        foreach ($prices as $index => $pricing) {
            if ($pricing instanceof ProductPricing) {
                unset($pricing->operation);
            } else if (is_array($pricing)) {
                unset($prices[$index]['operation']);
            }
        }

        $this->pricing = $prices;

        return $this;
    }

    /**
     * Add pricing
     *
     * @param ProductPricing $pricing
     *
     * @return $this
     */
    public function deletePrice(ProductPricing $pricing)
    {
        if (!isset($this->pricing)) {
            $this->pricing = [];
        }
        $pricing->operation = self::OPERATION_DELETE;

        $this->pricing[] = $pricing;

        return $this;
    }

    /**
     * Add a supplier product
     *
     * @param SupplierProduct $supplierProduct
     * @param string $operation
     *
     * @return $this
     */
    public function addSupplier(SupplierProduct $supplierProduct, string $operation = self::OPERATION_ADD)
    {
        if (!isset($this->suppliers)) {
            $this->suppliers = [];
        }
        $supplierProduct->operation = $operation;

        $this->suppliers[] = $supplierProduct;

        return $this;
    }

    /**
     * Replace All supplier products
     *
     * @param SupplierProduct|SupplierProduct[] $supplierProducts
     *
     * @return $this
     */
    public function replaceAllSuppliers($supplierProducts)
    {
        $supplierProducts = is_array($supplierProducts) ? $supplierProducts : [$supplierProducts];
        // unset operation property from suppliers
        foreach ($supplierProducts as $index => $supplierProduct) {
            if ($supplierProduct instanceof SupplierProduct) {
                unset($supplierProduct->operation);
            } else if (is_array($supplierProduct)) {
                unset($supplierProducts[$index]['operation']);
            }
        }

        $this->suppliers = $supplierProducts;

        return $this;
    }

    /**
     * Delete supplier product
     *
     * @param SupplierProduct $supplierProduct
     *
     * @return $this
     */
    public function deleteSupplier(SupplierProduct $supplierProduct)
    {
        if (!isset($this->suppliers)) {
            $this->suppliers = [];
        }
        $supplierProduct->operation = self::OPERATION_DELETE;

        $this->suppliers[] = $supplierProduct;

        return $this;
    }

    /**
     * Add a category
     *
     * @param ProductToCategory $category
     * @param string $operation
     *
     * @return $this
     */
    public function addToCategory(ProductToCategory $category, $operation = self::OPERATION_ADD)
    {
        if (!isset($this->categories)) {
            $this->categories = [];
        }
        $category->operation = $operation;

        $this->categories[] = $category;

        return $this;
    }

    /**
     * Add a category
     *
     * @param int $categoryId
     * @param bool $isPrimary
     * @param string $operation
     *
     * @return $this
     */
    public function addCategory(int $categoryId, bool $isPrimary = false, $operation = self::OPERATION_ADD)
    {
        if (!isset($this->categories)) {
            $this->categories = [];
        }

        $this->categories[] = [
            'category_id' => $categoryId,
            'is_primary' => $isPrimary,
            'operation' => $operation,
        ];

        return $this;
    }

    /**
     * Delete category
     *
     * @param int $categoryId
     *
     * @return $this
     */
    public function deleteCategory(int $categoryId)
    {
        if (!isset($this->categories)) {
            $this->categories = [];
        }

        $this->categories[] = ['category_id' => $categoryId, 'operation' => self::OPERATION_DELETE];

        return $this;
    }

    /**
     * Replace All categories
     *
     * @param ProductToCategory|ProductToCategory[] $categories
     *
     * @return $this
     */
    public function replaceAllCategories($categories)
    {
        $categories = is_array($categories) ? $categories : [$categories];
        // unset operation property from suppliers
        foreach ($categories as $index => $category) {
            if ($category instanceof ProductToCategory) {
                unset($category->operation);
            } else if (is_array($category)) {
                unset($categories[$index]['operation']);
            }
        }

        $this->categories = $categories;

        return $this;
    }

    /**
     * Set attribute groups by id
     *
     * @param int|array $attributeGroups
     *
     * @return Product
     */
    public function setAttributeGroups($attributeGroups)
    {
        $this->attribute_groups = is_array($attributeGroups) ? $attributeGroups : [$attributeGroups];

        $this->attribute_groups_operation = self::OPERATION_SET;

        return $this;
    }

    /**
     * Add attribute groups by id
     *
     * @param int|array $attributeGroups
     *
     * @return Product
     */
    public function addAttributeGroups($attributeGroups)
    {
        if (!isset($this->attribute_groups)) {
            $this->attribute_groups = [];
        }

        $this->attribute_groups = array_unique(array_merge($this->attribute_groups, is_array($attributeGroups) ? $attributeGroups : [$attributeGroups]));
        $this->attribute_groups_operation = isset($this->attribute_groups_operation) ? ($this->attribute_groups_operation == self::OPERATION_SET ? $this->attribute_groups_operation : self::OPERATION_APPEND) : self::OPERATION_APPEND;

        return $this;
    }

    /**
     * Delete attribute groups by id
     *
     * @param int|array $attributeGroups
     *
     * @return Product
     */
    public function deleteAttributeGroups($attributeGroups)
    {
        $this->attribute_groups = is_array($attributeGroups) ? $attributeGroups : [$attributeGroups];

        $this->attribute_groups_operation = self::OPERATION_DELETE;

        return $this;
    }

    /**
     * Add an attribute
     *
     * @param ProductAttribute $attribute
     * @param string $operation
     *
     * @return $this
     */
    public function addProductAttribute(ProductAttribute $attribute, string $operation = self::OPERATION_ADD)
    {
        if (!isset($this->attributes)) {
            $this->attributes = [];
        }
        $attribute->operation = $operation;

        $this->attributes[] = $attribute;

        return $this;
    }

    /**
     * @param int $componentId
     * @param int $quantity
     * @return $this
     */
    public function addBundleComponent(int $componentId, int $quantity)
    {
        if (!isset($this->components)) {
            $this->components = [];
        }

        $this->components[] = [
            'id' => $componentId,
            'quantity' => $quantity
        ];
        return $this;
    }

    /**
     * @param array $components
     * @return $this
     */
    public function addBundleComponents(array $components){
        foreach ($components as $component){
            $quantity = isset($component['quantity']) ? $component['quantity'] : $component['pivot']['quantity'];
            $this->addBundleComponent($component['id'], $quantity);
        }
        return $this;
    }

    /**
     * @param int $componentId
     * @return $this
     */
    public function removeBundleComponent(int $componentId){
        if (!isset($this->components)) {
            $this->components = [];
        }
        $this->components = array_filter($this->components, function($component) use ($componentId){
           return $component['id'] != $componentId;
        });
        return $this;
    }


    /**
     * Add an attribute
     *
     * @param int $attributeId
     * @param $value
     * @param string $operation
     *
     * @return $this
     */
    public function addAttribute(int $attributeId, $value, string $operation = self::OPERATION_ADD)
    {
        if (!isset($this->attributes)) {
            $this->attributes = [];
        }

        $this->attributes[] = ['id' => $attributeId, 'value' => $value, 'operation' => $operation];

        return $this;
    }

    /**
     * Delete an attribute
     *
     * @param int $attributeId
     * @param $value
     *
     * @return $this
     */
    public function deleteAttribute(int $attributeId)
    {
        if (!isset($this->attributes)) {
            $this->attributes = [];
        }

        $this->attributes[] = ['id' => $attributeId, 'operation' => self::OPERATION_DELETE];

        return $this;
    }

    /**
     * Replace All attributes
     *
     * @param ProductAttribute|ProductAttribute[]|array $attributes
     *
     * @return $this
     */
    public function replaceAllAttributes($attributes)
    {
        $attributes = is_array($attributes) ? $attributes : [$attributes];
        // unset operation property from suppliers
        foreach ($attributes as $index => $attribute) {
            if ($attribute instanceof ProductAttribute) {
                unset($attribute->operation);
            } else if (is_array($attribute)) {
                unset($attributes[$index]['operation']);
            }
        }

        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Add a variant
     *
     * @param Product $variant
     *
     * @return $this
     */
    public function addVariant(Product $variant)
    {
        if (!isset($this->variations)) {
            $this->variations = [];
        }

        $this->variations[] = $variant;

        return $this;
    }

    /**
     * @param int $warehouseId
     * @param int $quantity
     * @param float $unitCost
     */
    public function setInitialInventory(int $warehouseId, int $quantity, float $unitCost)
    {
        if (!isset($this->initial_inventory)) {
            $this->initial_inventory = [];
            $this->initial_inventory['warehouses'] = [];
        }

        $this->initial_inventory['warehouses'][] = ['id' => $warehouseId, 'quantity' => $quantity, 'unit_cost' => $unitCost];
    }

    public function __set($name, $value)
    {
        if ($name == 'type') {
            return $this->setProductType($value);
        }

        if ($name == 'weight_unit') {
            return $this->setWeightUnit($value);
        }

        if ($name == 'dimension_unit') {
            return $this->setDimensionUnit($value);
        }

        if ($name == 'case_dimension_unit' && !in_array($value, self::DIMENSION_UNITS)) {
            throw new InvalidArgumentException('The case_dimension_unit field must be one of ' . implode(',', self::DIMENSION_UNITS));
        }

        if ($name == 'case_weight_unit' && !in_array($value, self::WEIGHT_UNITS)) {
            throw new InvalidArgumentException('The case_weight_unit field must be one of ' . implode(',', self::WEIGHT_UNITS));
        }

        $this->$name = $value;
    }
}