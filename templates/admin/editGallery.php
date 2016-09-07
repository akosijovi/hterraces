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
 
      <form action="gallerys.php?action=<?php echo $results['formAction']?>" method="post" enctype="multipart/form-data" onsubmit="closeKeepAlive()">
        <input type="hidden" name="galleryId" value="<?php echo $results['gallery']->id ?>"/>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul>
 

            <input  type="hidden"   name="title" id="title" class="form-control"   placeholder="Name of the gallery" required autofocus maxlength="255" value="na" />
        	<div class="form-group"><label for="image">Name</label>
            <input type="text" name="summary" id="summary" class="form-control"   placeholder="Content of the summary" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['gallery']->summary )?>" />
</div>

            <textarea name="content"  id="content" class="form-control"   placeholder="The HTML content of the gallery" required maxlength="100000" style="display:none;">na</textarea>

            <input type="hidden"  type="date" name="publicationDate" id="publicationDate" class="form-control"   placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['gallery']->publicationDate ? date( "Y-m-d", $results['gallery']->publicationDate ) : "" ?>" />
          
 
		 <?php if ( $results['gallery'] && $imagePath = $results['gallery']->getImagePath() ) { ?>
          <div class="form-group">
           <label>Current Image</label>
            <div class="item" ><img class="img2" id="galleryImage" src="<?php echo $imagePath ?>" alt="Gallery Image" /></div>
          </div>
 
         
          <?php } ?>
 
          <div class="form-group">
            <label for="image">Add/Update Image</label>
            <input type="file" name="image" id="image" placeholder="Choose an image to upload" maxlength="255" />
          </div>
 
        </ul>
 
        <div class="buttons">
          <input class="btn btn-default" type="submit" name="saveChanges" value="Save Changes" />
          <input class="btn btn-default" type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>
 
      </form>
 
<?php if ( $results['gallery']->id ) { ?>
       <p style="padding-top:50px;"><a type="button" class="btn btn-block btn-info" href="gallerys.php?action=deleteGallery&amp;galleryId=<?php echo $results['gallery']->id ?>" onclick="return confirm('Delete This Gallery?')">Delete</a></p>
<?php } ?>
 
<?php include "templates/include/footer.php" ?>