<html>
  <head>
  <title>devk.it</title>
  <?php
  require( 'AssetManager.phps' );
    echo AssetManager::getInstance()
      ->addJavascript( 'jQuery' )
      ->addJavascript( 'devkit' )
      ->addJavascript( 'md5' )
      ->getGeneratedHtml();
  ?>
  <style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Permanent+Marker|Actor);

    body
    {
      margin: 0;
      padding: 0;
      border-top: solid 10px #5AB021;
      font-family: Arial, Helvetica;
    }

    h1
    {
      padding: 5px 20px;
      background: #eee;
      font-family: 'Permanent Marker', cursive;
      color: #333;
      border-bottom: 1px solid #ccc;
      border-top: 1px solid #34730A;
    }

    #container
    {
      border: 5px solid #fff;
      padding: 10px;
    }

    #tool-container
    {
      margin-top: 20px;
      padding: 10px;
      background: #eee;
      border: 1px solid #ddd;
      border-radius: 10px;
    }

    textarea
    {
      width: 100%;
      height: 200px;
      margin-bottom: 10px;
      font-family: Monospace, Courier New; 
      font-size: 12pt;
    }

    #history ul 
    {
      padding: 0;
    }

    #history ul li
    {
      background: #fff;
      border-radius: 4px;
      border: 2px solid #ddd;
      list-style-type: none;
      margin: 2px 0;
      padding: 3px;
      font-family: Monospace, Courier New;
    }

    #history ul li:hover
    {
      background: #fff;
      border-color: #FFCE1B;
      cursor: pointer;
    }

    button
    {
      margin: 0;
      font-family: 'Actor', cursive; 
      font-weight: bold;
      border: 1px solid #aaa;
      background: -webkit-gradient(linear, left top, left bottom, from(#eee), to(#ddd));
      padding: 10px 20px;
      text-transform: uppercase;
      color: #333;
    }
     
    button:hover
    {
      border-color: #888;
      -moz-box-shadow: 1px 1px 1px #bbb;
      -webkit-box-shadow: 1px 1px 1px #bbb;
      box-shadow: 1px 1px 1px #bbb;
      color: #333;
    }  
     
    button:active
    {
      background: #eee;
      border-color: #bbb;
      -moz-box-shadow: -1px -1px 1px #ccc;
      -webkit-box-shadow: -1px -1px 1px #ccc;
      box-shadow: -1px -1px 1px #ccc;
    }

    button.nonInput
    {
      background: -webkit-gradient(linear, left top, left bottom, from(#fee), to(#fdd));
    }

    #license
    {
      text-align: center;
      padding: 5px;
      margin-top: 20px;
    }

    a
    {
      color: #DB516F;
      text-decoration: none;
    }

  </style>
  </head>
  <body>

    <h1>devk.it</h1>
    <div id="container">
      Put text in the box, click butons to act on the text. Load history from below the box by clicking on the text in your history. History is stored with local storage, not on a remote machine.
      <div id="tool-container">
        <div class="groupTemplate">
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
      This shit's some kinda open-source, see? <a href="http://github.com/dallasgutauckis/devk.it/">Download devk.it</a>. Modify it. Attribute it to me... <a href="http://shinagle.com/">Dallas Gutauckis</a>
      <br />Mmmkay? Thanks.
    </div>

  </body>
</html>
