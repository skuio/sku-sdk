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
   * @param array $requestBody
   */
  public function __construct( int $statusCode, $response = null, $curlError = null, $requestBody = [] )
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
   * @param bool $withoutKeys
   *
   * @return array|null
   */
  public function getWarnings( $withoutKeys = true ): ?array
  {
    if ( ! isset( $this->response['warnings'] ) )
    {
      return null;
    }

    return $withoutKeys ? array_values( $this->response['warnings'] ) : $this->response['warnings'];
  }

  /**
   * @param bool $withoutKeys
   *
   * @return array|null
   */
  public function getErrors( $withoutKeys = true ): ?array
  {
    if ( ! isset( $this->response['errors'] ) )
    {
      return null;
    }

    return $withoutKeys ? array_values( $this->response['errors'] ) : $this->response['errors'];
  }

  /**
   * @return array|null
   */
  public function getCurlError()
  {
    return $this->curlError;
  }

  public function getStatus()
  {
    return $this->response['status'] ?? 'success';
  }

}