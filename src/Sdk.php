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
  public function authorizedRequest( string $endpoint, $body = null, string $method = self::METHOD_GET, $withCredentials = true )
  {
    $baseUrl = self::$config['environment'] == self::PRODUCTION ? self::$config['url'] : self::$config['dev_url'];

    $curl = curl_init();

    $headers = [
      "Accept: application/json",
      is_array( $body ) ? null : "Content-type: application/json",
    ];

    if ($withCredentials) {
      $headers[] = "Authorization: Bearer " . $this->getBasicToken();
    }

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
      CURLOPT_HTTPHEADER     => $headers,
    ] );

    $response  = curl_exec( $curl );
    $curlError = curl_error( $curl );
    $httpCode  = curl_getinfo( $curl, CURLINFO_HTTP_CODE );

    curl_close( $curl );

    return new Response( $httpCode, json_decode( $response, true ), $curlError );
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

    $response = $this->authorizedRequest('auth/login', [
        'email' => self::$config['username'],
        'password' => self::$config['password'],
        ],
        self::METHOD_POST,
        false
    );

    $accessToken = @$response->getResponse()['access_token'];

    if (!$accessToken) {
      print_r($response->getResponse());
      exit;
    }

    return $response->getResponse()['access_token'];
  }

  /**
   * Set API configurations
   *
   * @param array $config
   */
  public static function config( array $config )
  {
    self::$config = array_merge( self::$config, $config );
  }

    /**
     * @param DataType $dataType
     * @param Response $response
     * @return Response
     */
  protected function afterStore(DataType $dataType, Response $response){
      // After storing data, we may want to perform some tasks,
      // such as re-writing some data, etc.
      if($response->isSuccess()){
          $dataType->id = $response->getData()['id'];
      }

      return $response;
  }

}