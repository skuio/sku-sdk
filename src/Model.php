<?php

namespace Skuio\Sdk;

abstract class Model
{
  public function toArray()
  {
    $properties = get_object_vars( $this );

    return $this->propertiesToArray( $properties );
  }

  public function toJson()
  {
    return json_encode( $this->toArray() );
  }

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