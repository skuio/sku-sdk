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
    const OFFICE_ADDRESS_LABEL = 'Office';

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
     * @param $address
     * @return $this
     */
    public function addOfficeAddress($address){
        if(is_array($address)){
            $this->address = array_merge([
                'label' => self::OFFICE_ADDRESS_LABEL
            ], $address);
        }else if($address instanceof Address){
            if(!isset($address->label) && isset($address->name)){
                $address->label = $address->name;
            }else if(!isset($address->label)){
                $address->label = $address->name = self::OFFICE_ADDRESS_LABEL;
            }
            $this->address = $address;
        }else{
            $this->address = $address;
        }
        return $this;
    }

    
}