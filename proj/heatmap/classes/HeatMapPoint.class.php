<?php

require_once( 'Point.class.php' );

/**
 * Heat Map Point
 *
 * @author Dallas Gutauckis <dgutauckis@myyearbook.com>
 * @since 2009-10-14 00:23:28 EDT
 *
 */
class HeatMapPoint extends Point
{
  private $heat = 0;
  
  function adjustHeat( $difference = 1 )
  {
    $this->heat += $difference;
    return $this->heat;
  }
  
  function getHeat()
  {
    return $this->heat;
  }
}
