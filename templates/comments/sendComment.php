<?php include "templates/include/header.php" ?>
 

 
      <h2><?php echo $results['userTitle']?></h2>
 
      <form action="comments.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="userId" value="<?php echo $results['user']->id ?>"/>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul>
	<h3>Reply to:</h3><div class="form-group"> <h5> 
	<?php echo htmlspecialchars( $results['comment']->name)?> </br> 
	<?php echo htmlspecialchars( $results['comment']->summary)?></br>
	<h4>Message:</h4>
	&nbsp;&nbsp;<?php echo htmlspecialchars( $results['comment']->content)?></br>
	
	&nbsp;</br></h5>
          
            <label for="title">Subject Name</label>
            <input  class="form-control" type="text" name="title" id="title" placeholder="Reply Title" required autofocus maxlength="255" value="Re : <?php echo htmlspecialchars( $results['comment']->title )?>" />
          </div>

 
          <div class="form-group">
            <label for="title">Recipient</label>
            <input class="form-control"   type="text" name="summary" id="summary" placeholder="Email of the receiver" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['comment']->summary)?>" />
          </div>
 
 		<div class="form-group">
            <label for="content">Email Content</label>
            <textarea class="form-control"  name="content" id="content" placeholder="Content of the message" required maxlength="100000" style="height: 30em;"><?php echo htmlspecialchars( $results['article']->content )?></textarea>
          </div>
		
		  <textarea style="display:none;" class="form-control"  name="past" id="past" required maxlength="100000" style="height: 30em;"><?php echo htmlspecialchars( $results['comment']->content )?></textarea>
 
        </ul>
 
        <div class="buttons" style="margin-left:65%;">
          <input class="btn btn-default"  type="submit" name="saveChanges" value="Send" />
          <input class="btn btn-default"  type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>
 
      </form>
 

 
<?php include "templates/include/footer.php" ?>