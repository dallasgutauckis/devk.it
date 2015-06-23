<html>
  <head>
  <title>devk.it</title>
  <?php
    require( 'AssetManager.phps' );
    echo AssetManager::getInstance()
      ->addCss( 'home' )
      ->addJavascript( 'jQuery' )
      ->addJavascript( 'devkit' )
      ->addJavascript( 'md5' )
      ->getGeneratedHtml();
  ?>
  <style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Permanent+Marker|Actor);
  </style>
  </head>
  <body>

    <h1>devk.it</h1>
    <div id="container">
      <div id="tool-container">
        <div class="groupTemplate">
          <div id="instructions">
            Put text in the box, click buttons to act on the text. Load history from below the box by clicking on the text in your history. History is stored with local storage, not on a remote machine.
          </div>
          <textarea></textarea>
          <button class="unescape">Unescape</button>
          <button class="escape">Escape</button>
          <button class="base64Encode">Base 64 Encode</button>
          <button class="base64Decode">Base 64 Decode</button>
          <button class="md5">md5</button>
          <button class="length nonInput">string-length</button>
          <button class="lower">toLower</button>
          <button class="upper">toUpper</button>
          <button class="eval nonInput">eval()</button>
        </div>
        <div id="history">
          <ul>
          </ul>
        </div>
      </div>
    </div>

    <div id="license">
      This stuff is some kind of open-source, see? <a href="http://github.com/dallasgutauckis/devk.it/">Download devk.it</a>. Modify it. Attribute it to me... <a href="http://shinagle.com/">Dallas Gutauckis</a>
      <br />Mmkay? Thanks.
    </div>

    <script type="text/javascript">
   
     var _gaq = _gaq || [];
     _gaq.push(['_setAccount', 'UA-401905-5']);
     _gaq.push(['_trackPageview']);
   
     (function() {
       var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
       ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
     })();
   
    </script> 
  </body>
</html>
