<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
    var jQ = $.noConflict(true);
    jQ( document ).ready(function() {
    var currdate = new Date();
    var currdate= currdate.getFullYear() + '-' + (currdate.getMonth()+ 1) + '-' + currdate.getDate() ;
    jQ('input[name="publicationDate"]').val(currdate);
    });</script>
 
      

	 
      <form action="newComment.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="commentId" width="100%" value="<?php echo $results['comment']->id ?>"/>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
      	  <div class="form-group">
            <label for="title">Subject:</label>
            <input class="form-control"  type="text" name="title" id="title" width="100%" placeholder="Title of the comment" required maxlength="255" value="<?php echo htmlspecialchars( $results['comment']->title )?>" />
 			</div>

      	  <div class="form-group">
            <label for="title">Name:</label>
            <input class="form-control"  type="text" name="name" id="name" width="100%" placeholder="Name of the user" required maxlength="255" value="<?php echo htmlspecialchars( $results['comment']->name)?>" />
 			</div>
        
        	<div class="form-group">
            <label for="title">Email Address:</label>
            <input class="form-control" type="email" name="summary" id="summary" width="100%" placeholder="E-Mail Address" required maxlength="255" value="<?php echo htmlspecialchars( $results['comment']->summary )?>" />
            </div>
            
         	<div class="form-group">
            <label for="content">Comment:</label>
            <textarea class="form-control" name="content" id="content" placeholder="Message of the comment" width="100%" required maxlength="100000" style="height: 15em;"><?php echo htmlspecialchars( $results['comment']->content )?></textarea>
         	</div>
            
            <input type="hidden" type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" width="100%" required maxlength="10" value="<?php echo $results['comment']->publicationDate ? date( "Y-m-d", $results['comment']->publicationDate ) : "" ?>" />
            
	   <input type="hidden" type="text" name="hash" id="hash" width="100%" required value="<?php $hash = md5( rand(0,1000) ); echo $hash; ?>" />

           <input type="hidden" name="active" id="active" width="100%" required value="<?php echo $results['comment']->active ?>" />
           
        <div class="buttons"> 
          <input class="btn btn-default" type="submit" name="saveChanges" value="Submit" />
        </div>
      </form>

 	 <?php
		$homepage = "/index.php?status=sent";
		$currentpage = $_SERVER['REQUEST_URI'];
		if($homepage==$currentpage) {
		echo 
		    
		"<script>
			function myFunction() {
				alert(\"Your comment has been saved, please verify it by clicking the activation link that has been sent to your email.\");
				window.location = 'index.php';
			}
			</script>";
	echo"<iframe border=\"0\" height=\"0px\" width=\"0px\" onload=";echo"\"myFunction()\"";echo"></iframe>";
	
		}
		?>
<?php if ( $results['comment']->id ) { ?>
      
<?php } ?>