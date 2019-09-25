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
   * @var array|null
   */
  private $response;
  /**
   * @var array|null
   */
  private $error;

  /**
   * Response constructor.
   *
   * @param int $code
   * @param array|null $response
   * @param null $error
   */
  public function __construct( int $code, $response = null, $error = null )
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
   * @return array|null
   */
  public function getResponse(): ?array
  {
    return $this->response;
  }

  /**
   * @return array|null
   */
  public function getCurlError(): ?array
  {
    return $this->error;
  }

}