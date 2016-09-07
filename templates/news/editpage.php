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
 
      <h1><?php echo $results['pageTitle']?></h1>
 
      <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="pageId" value="<?php echo $results['page']->id ?>"/>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul>
 
          <li>
            <label for="title">Page Title</label>
            <input type="text" name="title" id="title" placeholder="Name of the page" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['page']->title )?>" />
          </li>
 
 		<li>
            <label for="title">Page Summary</label>
            <input type="text" name="summary" id="summary" placeholder="Content of the summary" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['page']->summary )?>" />
          </li>
          <li>
            <label for="content">Page Content</label>
            <textarea name="content" id="content" placeholder="The HTML content of the page" required maxlength="100000" style="height: 30em;"><?php echo htmlspecialchars( $results['page']->content )?></textarea>
          </li>
 
          <li>
            <input type="hidden"  type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['page']->publicationDate ? date( "Y-m-d", $results['page']->publicationDate ) : "" ?>" />
          </li>
 
 
        </ul>
 
        <div class="buttons">
          <input type="submit" name="saveChanges" value="Save Changes" />
          <input type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>
 
      </form>
 
<?php if ( $results['page']->id ) { ?>
       <p><a href="admin.php?action=deletePage&amp;pageId=<?php echo $results['page']->id ?>" onclick="return confirm('Delete This Page?')">Delete This Page</a></p>
<?php } ?>
 
<?php include "templates/include/footer.php" ?>