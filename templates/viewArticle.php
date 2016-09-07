<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hollywood Terraces</title>


    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="styles/style.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet">
	<script type="text/javascript" src="scripts/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/scroll.js"></script>

  </head>
  <body style="background-image:url(../images/blank.gif)">
      <h1 ><?php echo htmlspecialchars( $results['article']->title )?></h1>
      <p class="pubDate">Published on <?php echo date('j F Y', $results['article']->publicationDate)?></p>
      <div style="width: 90%; font-style: italic;"><?php echo htmlspecialchars( $results['article']->summary )?><br /><br>
<br>
</div>
      
      <div style="width: 90%; min-height: 300px;">
      <?php if ( $imagePath = $results['article']->getImagePath() ) { ?>
        <img id="articleImageFullsize" src="<?php echo $imagePath?>" alt="Article Image" />
      <?php } ?>
      <p><?php echo $results['article']->content?></p>
      </div>
  <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
	<script type="text/javascript" src="lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />
	<link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	
  </body>
</html>