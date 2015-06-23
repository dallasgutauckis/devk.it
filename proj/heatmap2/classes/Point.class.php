<?php

class Point
{
  function __construct( $x = 0, $y = 0, $z = 0 )
  {
    $this->x = $x;
    $this->y = $y;
    $this->z = $z;
  }
  
  function getCoordinates()
  {
    return array( 
      'x' => $this->x,
      'y' => $this->y,
      'z' => $this->z
    );
  }

  public function __toString()
  {
    return 'P(' . $this->x . ',' . $this->y . ')';
  }
}
