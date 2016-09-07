<?php include "templates/include/header.php" ?>
 


      <h2> Pages</h2>
 
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
							Name
						</th>
						<th>
							Description
						</th>
					</tr>
				</thead>
 			<tbody>
<?php foreach ( $results['pages'] as $page ) { ?>
 
        <tr onclick="location='admin.php?action=editPage&amp;pageId=<?php echo $page->id?>'">
          <td><?php echo $page->title?></td>
          <td>
            <?php echo $page->summary?>
          </td>
        </tr>
 
<?php } ?>
 
          </tbody>
        </table>
 
      <p></p>
 
 
 
<?php include "templates/include/footer.php" ?>