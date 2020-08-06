<?php

namespace Skuio\Sdk\Model;

use InvalidArgumentException;
use Skuio\Sdk\Model;

/**
 * Class Warehouse
 *
 * @package Skuio\Sdk\Model
 *
 * @property int $id
 * @property string $name
 * @property string $address_name
 * @property string $type
 * @property string $email
 * @property string $phone
 * @property string $fax
 * @property string $address1
 * @property string $address2
 * @property string $address3
 * @property string $city
 * @property string $province
 * @property string $province_code
 * @property string $zip
 * @property string $country
 * @property string $country_code
 * @property string $order_fulfillment
 * @property bool $dropship_enabled
 * @property bool $direct_returns
 * @property bool $customer_returns
 * @property bool $is_default
 * @property WarehouseLocation $default_location
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
    self::TYPE_SUPPLIER
  ];

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value )
  {
    if ( $name == 'type' && ! in_array( $value, self::TYPES ) )
    {
      throw new InvalidArgumentException( 'The warehouse type field must be one of ' . implode( ',', self::TYPES ) );
    }

    $this->$name = $value;
  }

    /**
     * @param WarehouseLocation $location
     * @return $this
     */
    public function setDefaultLocation(WarehouseLocation $location)
    {
      $this->default_location = $location;
      return $this;
  }
}