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
  private $errors;

  public function __construct( int $code, array $response, $errors )
  {
    $this->code     = $code;
    $this->response = $response;
    $this->errors   = is_array( $errors ) ? $errors : [ $errors ];
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
  public function getErrors(): array
  {
    return $this->errors;
  }

}