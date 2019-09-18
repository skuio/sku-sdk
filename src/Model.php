<?php

namespace Skuio\Sdk;

abstract class Model
{
  /**
   * Properties to array
   *
   * @return mixed
   */
  public function toArray()
  {
    $properties = get_object_vars( $this );

    return $this->propertiesToArray( $properties );
  }

  /**
   * Properties to JSON
   *
   * @return false|string
   */
  public function toJson()
  {
    return json_encode( $this->toArray() );
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
      } else if ( $value instanceof Model )
      {
        $properties[ $key ] = $value->toArray();
      }
    }

    return $properties;
  }
}