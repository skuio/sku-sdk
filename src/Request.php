<?php

namespace Skuio\Sdk;

use InvalidArgumentException;

/**
 * Class Request
 *
 * @package Skuio\Sdk\Products
 *
 */
class Request
{
  /**
   * Archived Status
   */
  const ARCHIVED_EXCLUDED = 0; // without archived
  const ARCHIVED_ONLY     = 1; // only archived
  const ARCHIVED_INCLUDED = 2; // both archived and unarchived

  /**
   * Table Specifications Status
   */
  const TS_EXCLUDED = 0; // without table specifications
  const TS_ONLY     = 1; // only table specifications without data
  const TS_INCLUDED = 2; // both table specifications and data
  /**
   * Total Status
   */
  const TOTAL_EXCLUDED = 0; // data without total(count)
  const TOTAL_ONLY     = 1; // only pagination info without data
  const TOTAL_INCLUDED = 2; // include total(count) to pagination info

  private $filters             = [];
  private $sort                = [];
  private $conjunction         = 'and';
  private $query               = '';
  private $limit               = 10;
  private $page                = 1;
  private $excluded            = [];
  private $included            = [];
  private $archived            = self::ARCHIVED_EXCLUDED;
  private $tableSpecifications = self::TS_EXCLUDED;
  private $total               = self::TOTAL_EXCLUDED;
  private $params              = [];

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
  public function setExcluded( array $exclude ): void
  {
    $this->excluded = $exclude;
  }

  /**
   * @param array $include
   */
  public function setIncluded( array $include ): void
  {
    $this->included = $include;
  }

  /**
   * @param int $archived
   */
  public function setArchivedStatus( int $archived ): void
  {
    if ( $archived < 1 && $archived > 2 )
    {
      throw new InvalidArgumentException( 'invalid archived status' );
    }

    $this->archived = $archived;
  }

  /**
   * @param int $tableSpecifications
   */
  public function setTableSpecificationsStatus( int $tableSpecifications ): void
  {
    if ( $tableSpecifications < 1 && $tableSpecifications > 2 )
    {
      throw new InvalidArgumentException( 'invalid table specifications status' );
    }

    $this->tableSpecifications = $tableSpecifications;
  }

  /**
   * @param int $total
   */
  public function setTotalStatus( int $total ): void
  {
    if ( $total < 1 && $total > 2 )
    {
      throw new InvalidArgumentException( 'invalid total status' );
    }

    $this->total = $total;
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

    if ( ! empty( $this->excluded ) )
    {
      $response['excluded'] = json_encode( $this->excluded );
    }

    if ( ! empty( $this->included ) )
    {
      $response['included'] = json_encode( $this->included );
    }

    if ( ! empty( $this->excluded ) && ! empty( $this->included ) )
    {
      throw new InvalidArgumentException( 'You can specify either included or excluded fields, but not both.' );
    }

    if ( ! empty( $this->archived ) )
    {
      $response['archived'] = $this->archived;
    }

    if ( ! empty( $this->tableSpecifications ) )
    {
      $response['table_specifications'] = $this->tableSpecifications;
    }

    if ( ! empty( $this->total ) )
    {
      $response['total'] = $this->total;
    }

    if ( ! empty( $this->params ) )
    {
      foreach ( $this->params as $key => $value )
      {
        $response[ $key ] = $value;
      }
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

  /**
   * @return string
   */
  public function setParam( $key, $value )
  {
    $this->params[ $key ] = $value;
  }
}