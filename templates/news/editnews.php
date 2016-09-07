<?php include "templates/include/header.php" ?>
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
    var jQ = $.noConflict(true);
    jQ( document ).ready(function() {
    var currdate = new Date();
    var currdate= currdate.getFullYear() + '-' + (currdate.getMonth()+ 1) + '-' + currdate.getDate() ;
    jQ('input[name="publicationDate"]').val(currdate);
    });</script>
 
 
      <div id="newsHeader">
        <h2>Widget News Admin</h2>
        <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="news.php?action=logout"?>Log out</a></p>
      </div>
 
      <h1><?php echo $results['newsTitle']?></h1>
 
      <form action="news.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="newsId" value="<?php echo $results['news']->id ?>"/>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul>
 
          <li>
            <label for="title">News Title</label>
            <input type="text" name="title" id="title" placeholder="Name of the news" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['news']->title )?>" />
          </li>
 
 		<li>
            <label for="title">News Summary</label>
            <input type="text" name="summary" id="summary" placeholder="Content of the summary" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['news']->summary )?>" />
          </li>
          <li>
            <label for="content">News Content</label>
            <textarea name="content" id="content" placeholder="The HTML content of the news" required maxlength="100000" style="height: 30em;"><?php echo htmlspecialchars( $results['news']->content )?></textarea>
          </li>
 
          <li>
            <input type="hidden"  type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['news']->publicationDate ? date( "Y-m-d", $results['news']->publicationDate ) : "" ?>" />
          </li>
 
 
        </ul>
 
        <div class="buttons">
          <input type="submit" name="saveChanges" value="Save Changes" />
          <input type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>
 
      </form>
 
<?php if ( $results['news']->id ) { ?>
       <p><a href="news.php?action=deleteNews&amp;newsId=<?php echo $results['news']->id ?>" onclick="return confirm('Delete This News?')">Delete This News</a></p>
<?php } ?>
 
<?php include "templates/include/footer.php" ?>