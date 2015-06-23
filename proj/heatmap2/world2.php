<?php

error_reporting( E_ALL ^ E_NOTICE );
ini_set( 'display_errors', 'On' );
ini_set( 'memory_limit', '256M' );
require_once( 'classes/HeatMapPlane.class.php' );

$minX = 22;
$minY = -134;
$maxX = 56;
$maxY = -60;

$sMultiplier = 10;

$minX = $minX * $sMultiplier;
$minY = $minY * $sMultiplier;
$maxX = $maxX * $sMultiplier;
$maxY = $maxY * $sMultiplier;

$plane = new HeatMapPlane( $minX, $minY, $maxX, $maxY );

$pdo = new PDO( 'pgsql:host=db35;dbname=production;user=www;' );
$query = 'SELECT member_latitude, member_longitude FROM member.details d JOIN member.feed_summaries fs USING (member_id) WHERE member_latitude IS NOT NULL ORDER BY fs.last_posted_at DESC LIMIT 100;';

$statement = $pdo->query( $query );
$coords = $statement->fetchAll( PDO::FETCH_ASSOC );

foreach ( $coords as $coord )
{
  list( $x, $y ) = array_values( $coord );
  $x = round( $x * $sMultiplier );
  $y = round( $y * $sMultiplier );
  $plane->recordHit( $x, $y, 2 );
}

$i = 1148;
$colors = array();
for ( $r = 382; $r >= 0; $r -= 1 )
{
  $rv = min( 255, $r );
  $g = 382 - $r; 
  $b = 0;
  $a = 0;
  $colors[$i--] = array( $rv, $g, $b, $a );
}

for ( $g = 382; $g >= 0; $g -= 1 )
{
  $gv = min( 255, $g );
  $r = 0;
  $b = 382 - $g;
  $a = 0;
  $colors[$i--] = array( $r, $gv, $b, $a );
}

for ( $b = 382; $b >= 0; $b -= 1 )
{
  $bv = min( 255, $b );
  $r = 0;
  $g = 0;
  $a = min( 382 - $b, 127 );
  $colors[$i--] = array( $r, $g, $bv, $a );
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

$multiplier = ( count( $colors ) - 1 ) / $maxHeat;

$orig = imagecreatefromgif( 'worldMap.gif' );
$dest = imagecreatetruecolor( 1549, 713 );
imagecopyresampled( $dest, $orig, 0, 0, 0, 0, 1539, 713, 1539, 713 );

$xFactor = 1549 * $sMultiplier / ( $maxX - $minX );
$yFactor = 713 * $sMultiplier / ( $maxY - $minY );

foreach ( $points as $x => $yValues )
{
  foreach ( $yValues as $y => $point )
  {
    $heat = $multiplier * $point->getHeat();
    $rgb = $heat;

    $r = $g = $b = 0;
    $a = 127;
    if ( $heat )
    {
      list( $r, $g, $b, $a ) = $colors[$heat];
      $a = min( $a + 50, 127 );
    }
    
//    var_dump( $a );
    
    $x1 = round( ( $x - $minX ) * $xFactor );
    $y1 = round( ( $y - $minY ) * $yFactor );
    $x2 = round( $x1 + $xFactor );
    $y2 = round( $y1 + $yFactor );
    
    $color = imagecolorallocatealpha( $dest, $r, $g, $b, $a );
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
