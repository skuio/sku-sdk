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
   * Response Status
   */
  const STATUS_SUCCESS = 'success';
  const STATUS_FAILURE = 'failure';
  const STATUS_WARNING = 'warning';

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
   * @param bool $withKeys
   *
   * @return array|null
   */
  public function getWarnings( $withKeys = false ): ?array
  {
    if ( ! isset( $this->response['warnings'] ) )
    {
      return null;
    }

    return $withKeys ? $this->response['warnings'] : $this->flattenArray( $this->response['warnings'] );
  }

  /**
   * @param bool $withKeys
   *
   * @return array|null
   */
  public function getErrors( $withKeys = false ): ?array
  {
    if ( ! isset( $this->response['errors'] ) )
    {
      return null;
    }

    return $withKeys ? $this->response['errors'] : $this->flattenArray( $this->response['errors'] );
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
    return $this->response['status'] ?? self::STATUS_SUCCESS;
  }

  /**
   * Determined if the response succeeded
   *
   * @return bool
   */
  public function isSuccess()
  {
    return $this->getStatus() === self::STATUS_SUCCESS;
  }

  /**
   * Determined if the response failure
   *
   * @return bool
   */
  public function isFailure()
  {
    return $this->getStatus() === self::STATUS_FAILURE;
  }

  /**
   * Determined if the response succeeded but have warnings
   *
   * @return bool
   */
  public function isWarning()
  {
    return $this->getStatus() === self::STATUS_WARNING;
  }

  private function flattenArray( array $array )
  {
    $result = [];
    foreach ( $array as $item )
    {
      $result = array_merge( $result, $item );
    }

    return $result;
  }
}