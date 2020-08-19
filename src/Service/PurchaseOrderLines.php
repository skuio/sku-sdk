<?php
/**
 * Created by PhpStorm.
 * User: brightantwiboasiako
 * Date: 7/24/20
 * Time: 11:29 AM
 */

namespace Skuio\Sdk\Service;

use Exception;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

/**
 * Class PurchaseOrderLines
 * @package Skuio\Sdk\Resource
 */
class PurchaseOrderLines extends Sdk
{

    protected $endpoint = 'purchase-order-lines';

    /**
     * Delete a purchase order line by id
     *
     * @param int $id
     *
     * @return Response
     * @throws Exception
     */
    public function delete( int $id )
    {
        return $this->authorizedRequest( $this->endpoint . '/' . $id, null, self::METHOD_DELETE );
    }

}