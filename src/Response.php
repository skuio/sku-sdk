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
  private $statusCode;
  /**
   * @var array|null
   */
  private $response;
  /**
   * @var array|null
   */
  private $curlError;

  /**
   * Response constructor.
   *
   * @param int $statusCode
   * @param array|null $response
   * @param null $curlError
   */
  public function __construct( int $statusCode, $response = null, $curlError = null )
  {
    $this->statusCode = $statusCode;
    $this->response   = $response;
    $this->curlError  = $curlError;
  }

  /**
   * @return int
   */
  public function getStatusCode(): int
  {
    return $this->statusCode;
  }

  /**
   * @return array|null
   */
  public function getResponse(): ?array
  {
    return $this->response;
  }

  public function getMessage(): ?string
  {
    return $this->response['message'] ?? null;
  }

  /**
   * @return array|null
   */
  public function getData(): ?array
  {
    return $this->response['data'] ?? null;
  }

  /**
   * @return array|null
   */
  public function getWarnings(): ?array
  {
    return $this->response['warnings'] ?? null;
  }

  /**
   * @return array|null
   */
  public function getErrors(): ?array
  {
    return $this->response['errors'] ?? null;
  }

  /**
   * @return array|null
   */
  public function getCurlError(): ?array
  {
    return $this->curlError;
  }

}