<?php namespace Skuio\Sdk;

class Sdk
{
  const SKU_URL     = 'https://sku.io/api';
  const SKU_DEV_URL = 'https://ord4.test/api';

  /**
   * Http method
   */
  const METHOD_GET    = 'GET';
  const METHOD_POST   = 'POST';
  const METHOD_PUT    = 'PUT';
  const METHOD_DELETE = 'DELETE';

  /**
   * @var string
   */
  private $username;
  /**
   * @var string
   */
  private $password;
  /**
   * @var string
   */
  private $baseUrl;

  /**
   * @var string
   */
  protected $endpoint = '';

  /**
   * Sdk constructor.
   *
   * @param string $username
   * @param string $password
   * @param bool $dev on development server
   */
  public function __construct( string $username, string $password, bool $dev = false )
  {
    $this->username = $username;
    $this->password = $password;
    $this->baseUrl  = $dev ? self::SKU_DEV_URL : self::SKU_URL;
  }

  /**
   * Make authorized request to the sku.io server
   *
   * @param string $endpoint
   * @param array|string(json) $body
   * @param string $method
   *
   * @return Response
   */
  public function authorizedRequest( string $endpoint, $body = null, string $method = self::METHOD_GET )
  {
    $curl = curl_init();

    curl_setopt_array( $curl, [
      CURLOPT_URL            => $this->baseUrl . '/' . ltrim( $endpoint, '/' ),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_MAXREDIRS      => 10,
      CURLOPT_TIMEOUT        => 30,
      CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST  => $method,
      CURLOPT_POSTFIELDS     => $body,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_HTTPHEADER     => array_filter( [
                                                "Accept: application/json",
                                                is_array( $body ) ? null : "Content-type: application/json",
                                                "Authorization: Basic " . $this->getBasicToken(),
                                              ] ),
    ] );

    $response  = curl_exec( $curl );
    $curlError = curl_error( $curl );
    $httpCode  = curl_getinfo( $curl, CURLINFO_HTTP_CODE );

    curl_close( $curl );

    if ( $curlError )
    {
      return new Response( $httpCode, [], $curlError );
    } else
    {
      return new Response( $httpCode, json_decode( $response, true ), [] );
    }
  }

  /**
   * build "Basic Auth" token from username and password
   *
   * @return string
   */
  private function getBasicToken()
  {
    return base64_encode( $this->username . ':' . $this->password );
  }
}