<?php

namespace Skuio\Sdk\Service;

use Exception;
use Skuio\Sdk\Response;
use Skuio\Sdk\Sdk;

class Images extends Sdk
{

  /**
   * Storing image to the server
   *
   * @param string $image image url or base64
   *
   * @return Response
   * @throws Exception
   */
  public function storeImage( string $image )
  {
    return $this->authorizedRequest( "store-image", json_encode( [ 'image' => $image ] ), Sdk::METHOD_POST );
  }

  /**
   * Removing image from the server
   *
   * @param string $imagePath
   *
   * @return Response
   * @throws Exception
   */
  public function deleteImage( string $imagePath )
  {
    return $this->authorizedRequest( "delete-image", json_encode( [ 'url' => $imagePath ] ), Sdk::METHOD_DELETE );
  }

}