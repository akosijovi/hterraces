<?php include "templates/include/header.php" ?>
 
<?php $countme=0;?>

      <h2> User <?php if($_SESSION['username']=='administrator'){echo 's';}?></h2>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
 
<?php if ( isset( $results['statusMessage'] ) ) { ?>
			<div class="alert alert-dismissable alert-info">
				 
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
					×
				</button>
				<?php echo $results['statusMessage'] ?>
			</div>
        <div class="statusMessage"></div>
<?php } ?>
 
      <table class="table table-striped">
				<thead>
					<tr>
						
						<th>
							Username
						</th>
						<th>
							Active
						</th>
					</tr>
				</thead>
 			<tbody>
<?php foreach ( $results['users'] as $users ) { ?>
<?php if($_SESSION['username']=='administrator') {include "user.php";}else{include "usern.php";}?>
<?php } ?>
 
  
          </tbody>
        </table>
      <p></p>
       <?php if($_SESSION['username']=='administrator') {?><h4><?php echo $countme ?> admin<?php echo ( $countme > 1 ) ? 's' : '' ?> activated.</h4><?php } ?>
 
      <?php if($_SESSION['username']=='administrator') { echo '<p><a href="users.php?action=newUsers" type="button" class="btn btn-block btn-info">Add a User</a></p> ';} ?>

<?php include "templates/include/footer.php" ?>