<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Jehova Jireh</title>    
  <link rel="stylesheet" 
        href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" 
        integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" 
        crossorigin="anonymous"> 
        
    {!! Html::style('css/app.css') !!}
  </head>
  <body>
    <div id="app"></div>
    <script>
      window.Laravel = <?php echo json_encode([
          'csrfToken' => csrf_token(),
      ]); ?>
    </script>   
   
    {!! Html::script('js/app.js') !!}
    
  </body>
</html>
