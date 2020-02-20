<?php

namespace Skuio\Sdk\Resource;

use Exception;
use InvalidArgumentException;
use Skuio\Sdk\Model\InitialInventoryCount;
use Skuio\Sdk\Model\InventoryAdjustment;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class Inventory extends Sdk
{
  protected $endpoint = 'inventory-management';

  /**
   * Set Initial Inventory Count for a product
   *
   * @param InitialInventoryCount $inventoryCount
   *
   * @return Response
   * @throws Exception
   */
  public function setInitialInventoryCount( InitialInventoryCount $inventoryCount )
  {
    return $this->authorizedRequest( "{$this->endpoint}/set-initial-inventory-count", $inventoryCount->toJson(), self::METHOD_POST );
  }

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