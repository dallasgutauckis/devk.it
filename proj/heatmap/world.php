<?php

require_once( 'classes/HeatMapPlane.class.php' );

$minX = 22;
$minY = -134;
$maxX = 56;
$maxY = -60;

$plane = new HeatMapPlane( $minX, $minY, $maxX, $maxY );

$lines = file_get_contents( 'feed_summaries.txt' );
$lines = explode( "\n", $lines );
foreach ( $lines as $line )
{
  if ( ! $line ) 
  {
    continue; 
  }
  
  list( $x, $y ) = explode( '|', $line );
  $x = round( trim( $x ) );
  $y = round( trim( $y ) );
  $plane->recordHit( $x, $y, 5 );
}

$i = 765;
$colors = array();
for ( $r = 255; $r >= 0; $r -= 1 )
{
  $g = 255 - $r;
  $b = 0;
  $colors[$i--] = array( $r, $g, $b );
}

for ( $g = 255; $g >= 0; $g -= 1 )
{
  $r = 0;
  $b = 255 - $g;
  $colors[$i--] = array( $r, $g, $b );
}

for ( $b = 255; $b >= 0; $b -= 1 )
{
  $r = 0;
  $g = 0;
  $colors[$i--] = array( $r, $g, $b );
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

$multiplier = 765 / $maxHeat;

$orig = imagecreatefromgif( 'worldMap.gif' );
$dest = imagecreatetruecolor( 1549, 713 );
imagecopyresampled( $dest, $orig, 0, 0, 0, 0, 1539, 713, 1539, 713 );

$xFactor = 1549 / ( $maxX - $minX );
$yFactor = 713 / ( $maxY - $minY );

if ( $_GET['debug'] == 1 )
  var_dump( $xFactor, $yFactor );

foreach ( $points as $x => $yValues )
{
  foreach ( $yValues as $y => $point )
  {
    $heat = $multiplier * $point->getHeat();
    $rgb = $heat;

    $r = $g = $b = 0;
    if ( $heat )
    {
      list( $r, $g, $b ) = $colors[$heat];
    }
    
    $x1 = round( ( $x - $minX ) * $xFactor );
    $y1 = round( ( $y - $minY ) * $yFactor );
    $x2 = round( $x1 + $xFactor );
    $y2 = round( $y1 + $yFactor );
    
    if ( $_GET['debug'] == 1 )
      var_dump( $x1, $y1, $x2, $y2 );
    
    $color = imagecolorallocatealpha( $dest, $r, $g, $b, 100 );
    imagefilledrectangle( $dest, $x1, $y1, $x2, $y2, $color );
    imagecolordeallocate( $dest, $color );
  }
}

if ( $_GET['debug'] != 1 )
{
  header( 'Content-type: image/jpeg' );
  imagejpeg( $dest );
}

?>
