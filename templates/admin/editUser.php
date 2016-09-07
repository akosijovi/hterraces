<?php include "templates/include/header.php" ?>
 

 
      <h2><?php echo $results['userTitle']?></h2>
 
      <form action="users.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="userId" value="<?php echo $results['user']->id ?>"/>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul>
		
		<?php if($results['user']->username=='administrator') { ?>

		<div class="form-group">
            <label for="title">Username</label>
            <input class="form-control"   type="text" name="username" id="username" placeholder="Username" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['user']->username )?>"  />
          </div> 

		<?php } ?>
		<?php if($results['user']->username!='administrator') { ?>
          <div class="form-group">
            <label for="title">Username</label>
            <input class="form-control"   type="text" name="username" id="username" placeholder="Username" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['user']->username )?>" />
          </div> <?php } ?>
 
 		<div class="form-group">
            <label for="title">Password</label>
            <input class="form-control"   type="password" name="password" id="password" placeholder="Password" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['user']->password )?>" />
          </div>
		  
		<?php if($_SESSION['username']=='administrator') { ?>
           <div class="form-group">
            <label for="title">Active?</label>
            <input class="form-control"   type="text" name="active" id="active" placeholder="0: Inactive 1:Active" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['user']->active )?>" <?php if($results['user']->username=='administrator') { echo ""; }?> /> 
		</div>
		
		
           <div class="form-group">
            <label for="title">Page</label>
            <input class="form-control"   type="text" name="page" id="page" placeholder="0: Inactive 1:Active" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['user']->page )?>" <?php if($results['user']->username=='administrator') { echo ""; }?> /> 
		</div>
		
		
           <div class="form-group">
            <label for="title">Gallery</label>
            <input class="form-control"   type="text" name="gallery" id="gallery" placeholder="0: Inactive 1:Active" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['user']->gallery )?>" <?php if($results['user']->username=='administrator') { echo ""; }?> /> 
		</div>
		
		
           <div class="form-group">
            <label for="title">News</label>
            <input class="form-control"   type="text" name="news" id="news" placeholder="0: Inactive 1:Active" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['user']->news )?>" <?php if($results['user']->username=='administrator') { echo ""; }?> /> 
		</div>
		
		
           <div class="form-group">
            <label for="title">Inbox</label>
            <input class="form-control"   type="text" name="comments" id="comments" placeholder="0: Inactive 1:Active" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['user']->comments )?>" <?php if($results['user']->username=='administrator') { echo ""; }?> /> 
		</div>
		
		
           <div class="form-group">
            <label for="title">Themes</label>
            <input class="form-control"   type="text" name="themes" id="themes" placeholder="0: Inactive 1:Active" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['user']->themes )?>" <?php if($results['user']->username=='administrator') { echo ""; }?> /> 
		</div>
		
	
		
 
		<?php } ?>
        </ul>
 
        <div class="buttons" style="margin-left:65%;">
          <input class="btn btn-default"  type="submit" name="saveChanges" value="Save Changes" />
          <input class="btn btn-default"  type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>
 
      </form>
 
<?php if ( $results['user']->id ) { ?>
		<?php if($_SESSION['username']=='administrator') {?>
<p style="padding-top:50px"><a type="button" class="btn btn-block btn-info" href="users.php?action=deleteUsers&amp;userId=<?php echo $results['user']->id ?>" onclick="return confirm('Delete This Admin?')">Delete User</a></p>
<?php } ?><?php } ?>
 
<?php include "templates/include/footer.php" ?>