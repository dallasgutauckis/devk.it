<?php

require_once( 'HeatMapPoint.class.php' );
require_once( 'CartesianPlane.class.php' );

/**
 * Heat Map Plane
 *
 * @author Dallas Gutauckis <dgutauckis@myyearbook.com>
 * @since 2009-10-14 00:24:36 EDT
 */
class HeatMapPlane extends CartesianPlane
{
  protected function buildPoint( $x, $y )
  {
    return new HeatMapPoint( $x, $y );
  }
  
  public function recordHit( $h, $k, $radius )
  {
    $h = round( $h );
    $k = round( $k );

    try
    {
      $this->getPoint( $h, $k )->adjustHeat( $radius );
    }
    catch ( Exception $e )
    {
    }
    // Determine if this point is on the circle
    // (r^2)= ((x-h)^2)+((y-k)^2)
    for ( $r = $radius; $r > 1; $r -= 1 )
    {
      for ( $x = $h - $r; $x <= $h + $r; $x += 1 )
      {
        $approxY = floor( sqrt( pow( $r, 2 ) - pow( ( $x - $h ), 2 ) ) + $k );
        
        for ( $y = $k - $r; $y <= $k + $r; $y += 1 )
        {
          $heat = ( ( $y - $approxY ) <= $radius ? ( $y == $approxY ? 1 : max( 0, ( $approxY - $y ) / $radius ) ) : 0 );
          try
          {
            $this->getPoint( $x, $y )->adjustHeat( $heat );
          } 
          catch ( Exception $e )
          {
          }
          
          try
          {
            $this->getPoint( $x, $k + ( $k - $y ) + 1 )->adjustHeat( $heat );
          } 
          catch ( Exception $e )
          {
          }
        }
      }
    }
    
    return true;
  }
}
