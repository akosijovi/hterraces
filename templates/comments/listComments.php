<?php include "templates/include/header.php" ?>
 
      
      <h2>Comments</h2>
 
<?php 
$countme=0;
if ( isset( $results['errorMessage'] ) ) { ?>
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
							Date Sent
						</th>
						<th>
							Comment
						</th>
					</tr>
				</thead>
 			<tbody>

<?php foreach ( $results['comments'] as $comment ) { ?>
 						<?php   if ($comment->active == 1){ include "showComments.php"; $countme+=1; }?>
						 
<?php } ?>
 
      </tbody>
        </table>
 
      <h4><?php echo $countme ?> comment<?php echo ( $countme > 1 ) ? 's' : '' ?> in total.</h4>
 
 
 
<?php include "templates/include/footer.php" ?>