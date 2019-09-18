<?php

namespace Skuio\Sdk;

/**
 * Class Response
 *
 * @package Skuio\Sdk
 *
 * The response that return from all requests
 */
class Response
{
  /**
   * @var int
   */
  private $code;
  /**
   * @var array
   */
  private $response;
  /**
   * @var array
   */
  private $error;

  public function __construct( int $code, array $response, $error )
  {
    $this->code     = $code;
    $this->response = $response;
    $this->error    = $error;
  }

  /**
   * @return int
   */
  public function getCode(): int
  {
    return $this->code;
  }

  /**
   * @return array
   */
  public function getResponse(): array
  {
    return $this->response;
  }

  /**
   * @return array
   */
  public function getCurlError(): array
  {
    return $this->error;
  }

}