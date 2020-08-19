<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 8/19/20
 * Time: 3:35 PM
 */

namespace Skuio\Sdk\Support;


trait Jsonable
{
    /**
     * Properties to JSON
     *
     * @return false|string
     */
    public function toJson()
    {
        return json_encode( $this->toArray() );
    }
}