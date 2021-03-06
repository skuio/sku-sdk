<?php

namespace Skuio\Sdk\Service;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\DataType\Import;
use Skuio\Sdk\DataType\Product;
use Skuio\Sdk\DataType\ProductImage;
use Skuio\Sdk\Query;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

/**
 * Class Products
 *
 * @package Skuio\Sdk\Products
 *
 * It will serve the "products" resource
 */
class Products extends Sdk
{
    protected $endpoint = 'products';

    /**
     * Retrieve products according to your request
     *
     * @param Query $request
     *
     * @return Response
     * @throws Exception
     */
    public function get(Query $request = null)
    {
        if (!$request) {
            $request = new Query();
        }

        return $this->authorizedRequest($this->endpoint . '?' . $request->getParams());
    }

    /**
     * Retrieve a product by id
     *
     * @param int $id
     * @param Query|null $request
     *
     * @return Response
     * @throws Exception
     */
    public function showById(int $id, Query $request = null)
    {
        if (!$request) {
            $request = new Query();
        }

        return $this->authorizedRequest("{$this->endpoint}/{$id}?{$request->getParams()}");
    }

    /**
     * Retrieve a product by sku
     *
     * @param string $sku
     * @param Query $request
     *
     * @return Response
     * @throws Exception
     */
    public function showBySku(string $sku, Query $request = null)
    {
        if (!$request) {
            $request = new Query();
        }

        return $this->authorizedRequest("{$this->endpoint}/by-sku/{$sku}?{$request->getParams()}");
    }

    /**
     * Create a new Product
     *
     * @param Product $product
     *
     * @return Response
     * @throws Exception
     */
    public function store(Product $product)
    {
        return $this->afterStore(
            $product,
            $this->authorizedRequest($this->endpoint, $product->toJson(), self::METHOD_POST)
        );
    }

    /**
     * Update a product
     *
     * @param Product $product
     *
     * @return Response
     * @throws Exception
     */
    public function update(Product $product)
    {
        if (empty($product->id)) {
            throw new InvalidArgumentException('The "id" field is required');
        }

        return $this->authorizedRequest($this->endpoint . '/' . $product->id, $product->toJson(), self::METHOD_PUT);
    }

    /**
     * Mark a product as archived
     *
     * @param int $id
     *
     * @return Response
     * @throws Exception
     */
    public function archive(int $id)
    {
        return $this->authorizedRequest("{$this->endpoint}/{$id}/archive", null, self::METHOD_PUT);
    }

    /**
     * UnArchived a product
     *
     * @param int $id
     *
     * @return Response
     * @throws Exception
     */
    public function unarchived(int $id)
    {
        return $this->authorizedRequest("{$this->endpoint}/{$id}/unarchived", null, self::METHOD_PUT);
    }

    /**
     * Delete a product
     *
     * @param int $id
     *
     * @return Response
     * @throws Exception
     */
    public function delete(int $id)
    {
        return $this->authorizedRequest("{$this->endpoint}/{$id}", null, self::METHOD_DELETE);
    }

    /**
     * Restore a deleted product
     *
     * @param string $sku
     *
     * @return Response
     * @throws Exception
     */
    public function restore(string $sku)
    {
        return $this->authorizedRequest("{$this->endpoint}/{$sku}/restore", null, self::METHOD_PUT);
    }

    /**
     * Retrieve deleted products
     *
     * @return Response
     * @throws Exception
     */
    public function getDeleted()
    {
        return $this->authorizedRequest("{$this->endpoint}/deleted");
    }

    /**
     * Import products from a CSV file
     *
     * @param Import $importProducts
     *
     * @return Response
     * @throws Exception
     */
    public function import(Import $importProducts)
    {
        if (empty($importProducts->csv_file)) {
            throw new InvalidArgumentException('The csv_file field is required');
        }

        return $this->authorizedRequest($this->endpoint . '/import', $importProducts->toArray(), self::METHOD_POST);
    }

    /**
     * Display product suppliers
     *
     * @param int $id
     *
     * @return Response
     * @throws Exception
     */
    public function suppliers(int $id)
    {
        return $this->authorizedRequest("{$this->endpoint}/$id/suppliers");
    }

    /**
     * Display all possible attributes for the product
     *
     * @param int $id
     *
     * @return Response
     * @throws Exception
     */
    public function attributes(int $id)
    {
        return $this->authorizedRequest("{$this->endpoint}/$id/attributes");
    }

    /**
     * Unset attributes to a product
     *
     * @param int $productId
     * @param int[] $attributes
     *
     * @return Response
     * @throws Exception
     */
    public function deleteAttributes(int $productId, array $attributes)
    {
        return $this->authorizedRequest("{$this->endpoint}/{$productId}/attributes", json_encode(['attributes' => $attributes]), self::METHOD_DELETE);
    }

    /**
     * Display inventory movements for the product
     *
     * @param int $id
     *
     * @return Response
     * @throws Exception
     */
    public function inventoryMovements(int $id)
    {
        return $this->authorizedRequest("{$this->endpoint}/$id/inventory-movements");
    }

    /**
     * @param int $productId
     * @return Response
     * @throws Exception
     */
    public function bundles(int $productId)
    {
      return $this->authorizedRequest("{$this->endpoint}/$productId/bundles");
    }

    /**
     * @param int $productId
     * @return Response
     * @throws Exception
     */
    public function components(int $productId)
    {
        return $this->authorizedRequest("{$this->endpoint}/$productId/components");
    }

    /**
     * Set default supplier to the product
     *
     * @param int $id
     *
     * @param int $supplierId
     *
     * @return Response
     * @throws Exception
     */
    public function setDefaultSupplier(int $id, int $supplierId)
    {
        return $this->authorizedRequest("{$this->endpoint}/{$id}/set-default-supplier/{$supplierId}", null, self::METHOD_PUT);
    }

    /**
     * Assign attribute groups to the product
     *
     * @param int $id
     * @param array $attributeGroupIds
     *
     * @return Response
     * @throws Exception
     */
    public function assignAttributeGroups(int $id, array $attributeGroupIds)
    {
        return $this->authorizedRequest("$this->endpoint/{$id}/assign-attribute-groups", json_encode(['attribute_groups_ids' => $attributeGroupIds]), Sdk::METHOD_PUT);
    }

    /**
     * Retrieve product constants data
     *
     * @return Response
     * @throws Exception
     */
    public function constants()
    {
        return $this->authorizedRequest($this->endpoint . '/constants');
    }

    /**
     * Display a list of product activity log
     *
     * @param int $id
     *
     * @return Response
     * @throws Exception
     */
    public function activityLog(int $id)
    {
        return $this->authorizedRequest("{$this->endpoint}/{$id}/activity-log");
    }

    /**
     * Retrieve product images
     *
     * @param int $productId
     *
     * @return Response
     * @throws Exception
     */
    public function images(int $productId)
    {
        return $this->authorizedRequest("{$this->endpoint}/{$productId}/images");
    }

    /**
     * Add a new image to product
     *
     * @param int $productId
     * @param ProductImage $productImage
     *
     * @return Response
     * @throws Exception
     */
    public function addImage(int $productId, ProductImage $productImage)
    {
        return $this->authorizedRequest("{$this->endpoint}/{$productId}/images", $productImage->toJson(), Sdk::METHOD_POST);
    }

    /**
     * Get product inventory details by product id
     *
     * @param int $productId
     *
     * @return Response
     * @throws Exception
     *
     */
    public function inventory(int $productId)
    {
        return $this->authorizedRequest("{$this->endpoint}/{$productId}/inventory");
    }

    /**
     * Bulk archive products
     *
     * @param Query|null $filters
     * @param array|null $productIds
     *
     * @return Response
     * @throws Exception
     */
    public function bulkArchive(Query $filters = null, array $productIds = null)
    {
        return $this->bulkOperation("{$this->endpoint}/archive", self::METHOD_PUT, $filters, $productIds);
    }


    /**
     * Bulk un archive products
     *
     * @param Query|null $filters
     * @param array|null $productIds
     *
     * @return Response
     * @throws Exception
     */
    public function bulkunArchive(Query $filters = null, array $productIds = null)
    {
        return $this->bulkOperation("{$this->endpoint}/unarchive", self::METHOD_PUT, $filters, $productIds);
    }


    /**
     * Bulk delete products
     *
     * @param Query|null $filters
     * @param array|null $productIds
     *
     * @return Response
     * @throws Exception
     */
    public function bulkDelete(Query $filters = null, array $productIds = null)
    {
        return $this->bulkOperation($this->endpoint, self::METHOD_DELETE, $filters, $productIds);
    }

    /**
     * Bulk operation
     *
     * @param string $endpoint
     * @param string $method
     * @param Query|null $filters
     * @param array|null $productIds
     *
     * @return Response
     * @throws Exception
     */
    private function bulkOperation(string $endpoint, string $method, Query $filters = null, array $productIds = null)
    {
        if (($filters && !empty($productIds)) || (!$filters && empty($productIds))) {
            throw new InvalidArgumentException('You must specify either filters or productIds parameters, but not both.');
        }

        // bulk operation by request filters
        if ($filters) {
            if (empty($filters->toArray()['filters'])) {
                throw new InvalidArgumentException('You must specify filters in request');
            }

            return $this->authorizedRequest($endpoint . '?' . $filters->getParams(), null, $method);
        }

        // bulk operation by product ids
        return $this->authorizedRequest($endpoint, json_encode(['ids' => $productIds]), $method);
    }
}