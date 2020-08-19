<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 8/19/20
 * Time: 3:34 PM
 */

namespace Skuio\Sdk\Support;


use Skuio\Sdk\DataType;

trait Arrayable
{

    /**
     * Properties to array
     *
     * @return array
     */
    public function toArray()
    {
        $properties = get_object_vars( $this );

        return $this->propertiesToArray( $properties );
    }

    /**
     * Recursive function to convert properties to array
     *
     * @param $properties
     *
     * @return mixed
     */
    private function propertiesToArray( $properties )
    {
        foreach ( $properties as $key => $value )
        {
            if ( is_array( $value ) )
            {
                $properties[ $key ] = $this->propertiesToArray( $value );
            } else if ( $value instanceof DataType )
            {
                $properties[ $key ] = $value->toArray();
            }
        }

        return $properties;
    }

}