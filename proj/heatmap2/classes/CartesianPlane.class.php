<?php

/**
 * Cartesian Plane Class
 *
 * @author Dallas Gutauckis <dgutauckis@myyearbook.com>
 * @since 2009-10-14 00:17:55 EDT
 */
class CartesianPlane
{
  private $points = array();

  function __construct( $minX = -10, $minY = -10, $maxX = 10, $maxY = 10 )
  {
    $this->minX = $minX;
    $this->minY = $minY;
    $this->maxX = $maxX;
    $this->maxY = $maxY;
    
    for ( $x = $minX; $x <= $maxX; $x += 1 )
    {
      $yValues = array();
      for ( $y = $minY; $y <= $maxY; $y += 1 )
      {
        $yValues[$y] = $this->buildPoint( $x, $y );
      }
      $this->points[$x] = $yValues;
    }
  }
  
  protected function buildPoint( $x, $y )
  {
    return new Point( $x, $y );
  }
  
  public function getPoint( $x, $y )
  {
    if ( $x > $this->maxX || $x < $this->minX || $y > $this->maxY || $y < $this->minY )
    {
      throw new Exception( 'Desired point (' . $x . ', ' . $y . ') is out of bounds of Cartesian Plane (' . $this->minX . ', ' . $this->minY . '),(' . $this->maxX . ', ' . $this->maxY . ')' );
    }
    
    return $this->points[$x][$y];
  }
  
  public function getPoints()
  {
    return $this->points;
  }
}

