<?php

namespace Skuio\Sdk\Model;

use Skuio\Sdk\Model;

/**
 * Class ImportProducts
 *
 * @package Skuio\Sdk\Model
 *
 * @property string $csv_file
 * @property string $csv_delimiter
 * @property string $csv_enclosure
 * @property bool $override - Override a product if exists?. Default value is 1.
 */
class ImportProducts extends Model
{
  public function __set( $name, $value )
  {
    if ( $name == 'csv_file' and is_string( $value ) )
    {
      if ( ! file_exists( $value ) )
      {
        throw new \Exception( 'The CSV file not exits' );
      }
      $this->$name = curl_file_create( $value );
    } else
    {
      $this->$name = $value;
    }
  }
}