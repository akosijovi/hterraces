<?php include "templates/include/header.php" ?>

<p>Title:  <?php echo $results['comment']->title?></p> 
     <p>Name: <?php echo $results['comment']->name?></p>
     <p>Email:  <?php echo $results['comment']->summary?></p>
     <p>Date Sent: <?php echo date('j M Y', $results['comment']->publicationDate)?></p>
<p>Comment: <?php echo $results['comment']->content?></p>
      
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p><a href="./comments.php">Return to Comments Page</a></p>
 
<?php if ( $results['comment']->id ) { ?>
       <p style="padding-top:50px;"><a type="button" class="btn btn-block btn-info" href="comments.php?action=sendComment&amp;commentId=<?php echo $results['comment']->id ?>" >Reply</a></p>
<?php } ?> 

<?php if ( $results['comment']->id ) { ?>
       <p style="padding-top:0px;"><a type="button" class="btn btn-block btn-info" href="comments.php?action=deleteComment&amp;commentId=<?php echo $results['comment']->id ?>" onclick="return confirm('Delete This Comment?')">Delete</a></p>
<?php } ?>

<?php include "templates/include/footer.php" ?>