<?php include "templates/include/header.php" ?>
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
    var jQ = $.noConflict(true);
    jQ( document ).ready(function() {
    var currdate = new Date();
    var currdate= currdate.getFullYear() + '-' + (currdate.getMonth()+ 1) + '-' + currdate.getDate() ;
    jQ('input[name="publicationDate"]').val(currdate);
    });</script>
 

 
      <h2><?php echo $results['pageTitle']?></h2>
 
      <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="pageId" value="<?php echo $results['page']->id ?>"/>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul>
 
          <div class="form-group">
            <label for="title">Page Title</label>
            <input class="form-control"   type="text" name="title" id="title" placeholder="Name of the page" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['page']->title )?>" />
          </div>
 
 		<div class="form-group">
            <label for="title">Page Summary</label>
            <input class="form-control"   type="text" name="summary" id="summary" placeholder="Content of the summary" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['page']->summary )?>" />
          </div>
          <div class="form-group">
            <label for="content">Page Content</label>
            <textarea class="form-control"   name="content" id="content" placeholder="The HTML content of the page" required maxlength="100000" style="height: 30em;"><?php echo htmlspecialchars( $results['page']->content )?></textarea>
          </div>
 
          <div class="form-group">
            <input  type="hidden"  type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['page']->publicationDate ? date( "Y-m-d", $results['page']->publicationDate ) : "" ?>" />
          </div>
 
 
        </ul>
 
        <div class="buttons" style="margin-left:65%;">
          <input class="btn btn-default"  type="submit" name="saveChanges" value="Save Changes" />
          <input class="btn btn-default"  type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>
 
      </form>
 
 
<?php include "templates/include/footer.php" ?>