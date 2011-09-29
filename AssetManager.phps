<?php

/**
 * Asset manager (CSS and JS)
 *
 * @author Dallas Gutauckis <dallas@gutauckis.com>
 * @since 2011-01-16 00:44:25 EST
 */

class AssetManager
{
  /**
   * The prefix prepended to our asset urls
   */
  const ASSETS_URL_PREFIX = 'http://devk.it/puree/';
  
  protected $cssFiles = array();
  protected $jsFiles = array();
  protected $externalJsFiles = array();
  
  /**
   * Singleton function
   *
   * @return AssetManager
   */
  public static function getInstance()
  {
    static $instance = false;
    if ( $instance === false )
    {
      $instance = new AssetManager();
    }
    
    return $instance;
  }
  
  // Prevent public construction and replication
  protected function __construct() {}
  protected function __clone() {}
  
  /**
   * Add the given file to our CSS list
   *
   * @param string $filename
   * @param string $media The media types this CSS is for. No validation is performed
   * @return AssetManager
   */
  public function addCss( $filename, $media = 'screen' )
  {
    if ( false === isset( $this->cssFiles[$media] ) )
    {
      $this->cssFiles[$media] = array( $filename );
      return;
    }
    
    $this->cssFiles[$media][] = $filename;
    return $this;
  }
  
  /**
   * Add the given file to our Javascript list
   * 
   * @param string $filename
   * @return AssetManager
   */
  public function addJavascript( $filename )
  {
    $this->jsFiles[] = $filename;
    return $this;
  }
  
  /**
   * Add the given external file to our file list
   *
   * @param string $uri
   * @return AssetManager
  public function addExternalJavascript( $uri )
  {
    $this->externalJsFiles[] = $uri;
    return $this;
  }
  
  /**
   * Get the elements (script/link) that go into the head node of an HTML document
   *
   * @return string representing the HTML
   */
  public function getGeneratedHtml()
  {
    $cssFilepath = self::ASSETS_URL_PREFIX . 'css/';
    $jsFilepath = self::ASSETS_URL_PREFIX . 'js/';
    
    $elements = '';
    
    foreach ( $this->cssFiles as $media => $cssFiles )
    {
      $elements .= '<link rel="stylesheet" media="' . $media . '" href="' . $cssFilePath . implode( ';', $cssFiles ) . '" />' . "\n";
    }
    
    $elements .= '<script type="text/javascript" src="' . $jsFilepath . implode( ';', $this->jsFiles ) . '"></script>' . "\n";
    if ( count( $this->externalJsFiles ) > 0 )
    {
      $elements .= '<script type="text/javascript" src="';
      $elements .= implode( '"></script><script type="text/javascript" src="' );
      $elements .= '"></script>';
    }
    
    return $elements;
  }
}
