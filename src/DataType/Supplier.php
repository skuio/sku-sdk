<?php

namespace Skuio\Sdk\DataType;

use Skuio\Sdk\DataType;

/**
 * Class Vendor
 *
 * @package Skuio\Sdk\DataType
 *
 * @property int $id
 * @property string $name
 * @property string $company_name
 * @property string|null $primary_contact_name
 * @property string|null $email
 * @property string|null $purchase_order_email
 * @property string|null $phone
 * @property string|null $website
 * @property float|null $leadtime
 * @property float|null $minimum_order_quantity
 * @property float|null $minimum_purchase_order
 * @property array|null $address
 * @property Warehouse $warehouse
 */
class Supplier extends DataType
{

    /**
     * @param Warehouse $warehouse
     * @return $this
     */
    public function addWarehouse(Warehouse $warehouse )
    {
        $this->warehouse = $warehouse;
        return $this;
    }


    /**
     * Sets the office address
     *
     * @param array $address
     */
    public function setOfficeAddress(array $address){
        $this->address = $address;
    }


    /**
     * @param string $field
     * @param string $value
     * @return $this
     */
    public function addOfficeAddressField(string $field, string $value){
        if(!isset($this->address)){
            $this->address = [];
        }
        $this->address[$field] = $value;
        return $this;
    }

    
}