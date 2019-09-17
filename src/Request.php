<?php

namespace Skuio\Sdk;

/**
 * Class Request
 *
 * @package Skuio\Sdk\Products
 *
 *
 */
class Request
{
  private $filters     = [];
  private $sort        = [];
  private $conjunction = 'and';
  private $query       = '';

  public function setConjunction( string $conjunction = 'and' )
  {
    $this->conjunction = $conjunction;
  }

  public function setQuery( string $query )
  {
    $this->query = $query;
  }

  public function addFilter( string $key, string $operator, $value = null )
  {
    $this->filters[] = [ 'column' => $key, 'operator' => $operator, 'value' => $value ];
  }

  public function addSort( string $key, bool $ascending = true )
  {
    $this->sort[] = [ 'column' => $key, 'ascending' => $ascending ];
  }

  public function toArray()
  {
    $response = [];
    if ( ! empty( $this->filters ) )
    {
      $response['filters'] = json_encode( [ 'conjunction' => $this->conjunction, 'filterSet' => $this->filters ] );
    }

    if ( ! empty( $this->sort ) )
    {
      $response['sortObjs'] = json_encode( $this->sort );
    }

    if ( ! empty( $this->query ) )
    {
      $response['query'] = $this->query;
    }

    return $response;
  }

  public function getParams()
  {
    return http_build_query( $this->toArray() );
  }
}