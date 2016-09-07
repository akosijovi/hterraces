<?php include "templates/include/header.php" ?>
 
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
    var jQ = $.noConflict(true);
    jQ( document ).ready(function() {
    var currdate = new Date();
    var currdate= currdate.getFullYear() + '-' + (currdate.getMonth()+ 1) + '-' + currdate.getDate() ;
    jQ('input[name="publicationDate"]').val(currdate);
    });</script>
 
      <div id="adminHeader">
        <h2>Widget News Admin</h2>
        <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></p>
      </div>
 	 <?php
		$homepage = "/New%20folder%20(3)/cms/newComment.php?status=changesSaved";
		$currentpage = $_SERVER['REQUEST_URI'];
		if($homepage==$currentpage) {
		echo "<p>Comment Success!!</p>"	;
		}
		?></h1>
     
	 
      <h1><?php echo $results['pageTitle']?></h1>
 
      <form action="comments.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="commentId" value="<?php echo $results['comment']->id ?>"/>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul>
 
          <li>
            <label for="title">Comment Title</label>
            <input type="text" name="title" id="title" placeholder="Title of the comment" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['comment']->title )?>" />
          </li>
 
 		<li>
            <label for="title">E-Mail Address</label>
            <input type="email" name="summary" id="summary" placeholder="E-Mail Address" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['comment']->summary )?>" />
          </li>
          <li>
            <label for="content">Comment Content</label>
            <textarea name="content" id="content" placeholder="Message of the comment" required maxlength="100000" style="height: 30em;"><?php echo htmlspecialchars( $results['comment']->content )?></textarea>
          </li>
 
          <li>
            <input type="hidden"  type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['comment']->publicationDate ? date( "Y-m-d", $results['comment']->publicationDate ) : "" ?>" />
            
            
          </li>
 
 
        </ul>
 
        <div class="buttons">
          <input type="submit" name="saveChanges" value="Send" />
          <input type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>
 
      </form>
 
<?php if ( $results['comment']->id ) { ?>
      <p><a href="comments.php?action=deleteComment&amp;commentId=<?php echo $results['comment']->id ?>" onclick="return confirm('Delete This Comment?')">Delete This Comment</a></p>
<?php } ?>
 
<?php include "templates/include/footer.php" ?>