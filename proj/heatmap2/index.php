<?php

require_once( 'classes/HeatMapPlane.class.php' );

$minX = 0;
$minY = -100000;
$maxX = 100000;
$maxY = 0;

$plane = new HeatMapPlane( $minX, $minY, $maxX, $maxY );

$origins = array();
for ( $i = 0; $i <= 100; $i += 1 )
{
  $x = rand( $minX, $maxX );
  $y = rand( $minY, $maxY );
  
  $origins[] = array( $x, $y );
  
  $plane->recordHit( $x, $y, 10 );
}

$i = 765;
$colors = array();
for ( $r = 255; $r >= 0; $r -= 1 )
{
  $g = 255 - $r;
  $b = 0;
  $colors[--$i] = array( $r, $g, $b );
}

for ( $g = 255; $g >= 0; $g -= 1 )
{
  $r = 0;
  $b = 255 - $g;
  $colors[--$i] = array( $r, $g, $b );
}

for ( $b = 255; $b >= 0; $b -= 1 )
{
  $r = 0;
  $g = 0;
  $colors[--$i] = array( $r, $g, $b );
}

$points = $plane->getPoints();

$maxHeat = 0;
foreach ( $points as $x => $yValues )
{
  foreach ( $yValues as $y => $point )
  {
    $maxHeat = max( $maxHeat, $point->getHeat() );
  }
}

$multiplier = 764 / $maxHeat;

foreach ( $points as $x => $yValues )
{
  echo '<div>';
  foreach ( $yValues as $y => $point )
  {
    $heat = $multiplier * $point->getHeat();
    $rgb = $heat;

    $r = $g = $b = 0;
    if ( $heat )
    {
      list( $r, $g, $b ) = $colors[$heat];
    }
    
    if ( isset( $_GET['showOrigins'] ) && in_array( array( $x, $y ), $origins ) )
    {
      $r = $g = $b = 255;
    }
    
    echo '<div style="float:left;background-color:rgb(' . $r . ',' . $g . ',' . $b . ');width:5px;height:5px;" title="' . $point->getHeat() . '"></div>';
  }
  echo '</div><div style="clear:both"></div>' . "\n";
}

//var_dump( memory_get_usage() / ( 1024 * 1024 ) );

?>
