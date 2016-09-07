<?php include "templates/include/header.php" ?>
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
    var jQ = $.noConflict(true);
    jQ( document ).ready(function() {
    var currdate = new Date();
    var currdate= currdate.getFullYear() + '-' + (currdate.getMonth()+ 1) + '-' + currdate.getDate() ;
    jQ('input[name="publicationDate"]').val(currdate);
    });</script>
	 <script>
 
      // Prevents file upload hangs in Mac Safari
      // Inspired by http://airbladesoftware.com/notes/note-to-self-prevent-uploads-hanging-in-safari
 
      function closeKeepAlive() {
        if ( /AppleWebKit|MSIE/.test( navigator.userAgent) ) {
          var xhr = new XMLHttpRequest();
          xhr.open( "GET", "/ping/close", false );
          xhr.send();
        }
      }
 
      </script>
 
      <h2><?php echo $results['pageTitle']?></h2>
 
      <form action="articles.php?action=<?php echo $results['formAction']?>" method="post" enctype="multipart/form-data" onsubmit="closeKeepAlive()">
        <input type="hidden" name="articleId" value="<?php echo $results['article']->id ?>"/>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul>
 
          <div class="form-group">
            <label for="title">Page Title</label>
            <input  class="form-control" type="text" name="title" id="title" placeholder="Name of the article" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['article']->title )?>" />
          </div>
 
 		<div class="form-group">
            <label for="title">Page Summary</label>
            <input class="form-control"  type="text" name="summary" id="summary" placeholder="Content of the summary" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['article']->summary )?>" />
          </div>
          <div class="form-group">
            <label for="content">Page Content</label>
            <textarea class="form-control"  name="content" id="content" placeholder="The HTML content of the article" required maxlength="100000" style="height: 30em;"><?php echo htmlspecialchars( $results['article']->content )?></textarea>
          </div>
 
          <div class="form-group">
            <input type="hidden"  type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['article']->publicationDate ? date( "Y-m-d", $results['article']->publicationDate ) : "" ?>" />
          </div>
 
		 <?php if ( $results['article'] && $imagePath = $results['article']->getImagePath() ) { ?>
          <div class="form-group">
            <label>Current Image</label>
            <div class="item" ><img class="img2"  id="articleImage" src="<?php echo $imagePath ?>" alt="Article Image" /></div>
          </div>
 
          <div class="form-group">
            <label></label>
            <input type="checkbox" name="deleteImage" id="deleteImage" value="yes"/ > <label for="deleteImage">Delete</label>
          </div>
          <?php } ?>
 
          <div class="form-group">
            <label for="image">New Image</label>
            <input type="file" name="image" id="image" placeholder="Choose an image to upload" maxlength="255" />
          </div>
 
        </ul>
 
        <div class="buttons">
          <input class="btn btn-default" type="submit" name="saveChanges" value="Save Changes" />
          <input class="btn btn-default" type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>
 
      </form>
 
<?php if ( $results['article']->id ) { ?>
       <p style="padding-top:50px"><a type="button" class="btn btn-block btn-info" href="articles.php?action=deleteArticle&amp;articleId=<?php echo $results['article']->id ?>" onclick="return confirm('Delete This Article?')">Delete</a></p>
<?php } ?>
 
<?php include "templates/include/footer.php" ?>