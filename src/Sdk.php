<?php namespace Skuio\Sdk;

use Exception;

class Sdk
{
  /**
   * Environments
   */
  const PRODUCTION  = 'production';
  const DEVELOPMENT = 'development';

  /**
   * API configurations
   *
   * @var array
   */
  public static $config = [
    'url'         => 'https://sku.io/api',
    'dev_url'     => 'https://dev.sku.io/api',
    'environment' => self::PRODUCTION,
    'username'    => null,
    'password'    => null,
  ];

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
  protected $endpoint = '';

  /**
   * Sdk constructor.
   *
   * @param array $config
   */
  public function __construct( array $config = [] )
  {
    self::config( $config );
  }

  /**
   * Make authorized request to the sku.io server
   *
   * @param string $endpoint
   * @param array|string(json) $body
   * @param string $method
   *
   * @return Response
   * @throws Exception
   */
  public function authorizedRequest( string $endpoint, $body = null, string $method = self::METHOD_GET )
  {
    $baseUrl = self::$config['environment'] == self::PRODUCTION ? self::$config['url'] : self::$config['dev_url'];

    $curl = curl_init();

    curl_setopt_array( $curl, [
      CURLOPT_URL            => $baseUrl . '/' . ltrim( $endpoint, '/' ),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_MAXREDIRS      => 10,
      CURLOPT_TIMEOUT        => 30,
      CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST  => $method,
      CURLOPT_POSTFIELDS     => $body,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_FOLLOWLOCATION => true,
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
      return new Response( $httpCode, null, $curlError );
    } else
    {
      return new Response( $httpCode, json_decode( $response, true ) );
    }
  }

  /**
   * build "Basic Auth" token from username and password
   *
   * @return string
   * @throws Exception
   */
  private function getBasicToken()
  {
    if ( empty( self::$config['username'] ) or empty( self::$config['password'] ) )
    {
      throw new Exception( 'The username and password fields are required. Set on SDK config' );
    }

    return base64_encode( self::$config['username'] . ':' . self::$config['password'] );
  }

  /**
   * Set API configurations
   *
   * @param array $config
   */
  public static function config( array $config )
  {
    foreach ( $config as $key => $value )
    {
      self::$config[ $key ] = $value;
    }
  }
}