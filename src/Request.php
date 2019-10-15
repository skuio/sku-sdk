<?php

namespace Skuio\Sdk;

/**
 * Class Request
 *
 * @package Skuio\Sdk\Products
 *
 */
class Request
{
  private $filters          = [];
  private $sort             = [];
  private $conjunction      = 'and';
  private $query            = '';
  private $limit            = 10;
  private $page             = 1;
  private $exclude          = [];
  private $archived         = false;
  private $include_archived = false;

  /**
   * Filter between columns "and" or "or"
   *
   * @param string $conjunction - <and>|<or>
   */
  public function setConjunction( string $conjunction )
  {
    $this->conjunction = $conjunction;
  }

  /**
   * Filter in All fields
   *
   * @param string $query
   */
  public function setQuery( string $query )
  {
    $this->query = $query;
  }

  /**
   * Add new filter on a column
   *
   * @param string $key
   * @param string $operator
   * @param null $value
   */
  public function addFilter( string $key, string $operator, $value = null )
  {
    $this->filters[] = [ 'column' => $key, 'operator' => $operator, 'value' => $value ];
  }

  /**
   * Add new sort on a column
   *
   * @param string $key
   * @param bool $ascending
   */
  public function addSort( string $key, bool $ascending = true )
  {
    $this->sort[] = [ 'column' => $key, 'ascending' => $ascending ];
  }

  /**
   * Set Per page
   *
   * @param int $limit
   */
  public function setLimit( int $limit )
  {
    $this->limit = $limit;
  }

  /**
   * Set current page
   *
   * @param int $page
   */
  public function setPage( int $page )
  {
    $this->page = $page;
  }

  /**
   * @param array $exclude
   */
  public function setExclude( array $exclude ): void
  {
    $this->exclude = $exclude;
  }

  /**
   * @param bool $archived
   */
  public function setArchived( bool $archived ): void
  {
    $this->archived = $archived;
  }

  /**
   * @param bool $include_archived
   */
  public function setIncludeArchived( bool $include_archived ): void
  {
    $this->include_archived = $include_archived;
  }

  /**
   * @return array
   */
  public function toArray()
  {
    $response = [ 'limit' => $this->limit, 'page' => $this->page ];

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

    if ( ! empty( $this->exclude ) )
    {
      $response['excluded'] = json_encode( $this->exclude );
    }

    if ( ! empty( $this->archived ) )
    {
      $response['archived'] = $this->archived ? '1' : '0';
    }

    if ( ! empty( $this->include_archived ) )
    {
      $response['include_archived'] = $this->include_archived ? '1' : '0';
    }

    return $response;
  }

  /**
   * @return string
   */
  public function getParams()
  {
    return http_build_query( $this->toArray() );
  }
}