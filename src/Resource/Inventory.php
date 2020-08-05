<?php

namespace Skuio\Sdk\Resource;

use Exception;
use Skuio\Sdk\Model\InventoryAdjustment;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class Inventory extends Sdk
{
  protected $endpoint = 'inventory-management';


  /**
   * Adjust Inventory for a product
   *
   * @param InventoryAdjustment|InventoryAdjustment[] $inventoryAdjustment
   *
   * @return Response
   * @throws Exception
   */
  public function inventoryAdjustments( $inventoryAdjustment )
  {
    $adjustments = [];
    if ( is_array( $inventoryAdjustment ) )
    {
      foreach ( $inventoryAdjustment as $adjustment )
      {
        $adjustments[] = $this->getInventoryAdjustment( $adjustment );
      }
    } else
    {
      $adjustments[] = $this->getInventoryAdjustment( $inventoryAdjustment );
    }

    return $this->authorizedRequest( "{$this->endpoint}/inventory-adjustment", json_encode( [ 'adjustments' => $adjustments ] ), self::METHOD_POST );
  }

  private function getInventoryAdjustment( InventoryAdjustment $inventoryAdjustment )
  {
    return $inventoryAdjustment->toArray();
  }
}