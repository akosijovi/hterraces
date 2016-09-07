<?php include "templates/include/header.php" ?>
 


      <h2>News</h2>
 
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
<?php foreach ( $results['articles'] as $article ) { ?>
 
        <tr onclick="location='articles.php?action=editArticle&amp;articleId=<?php echo $article->id?>'">
          <td><?php echo $article->title?></td>
          <td>
            <?php echo $article->summary?>
          </td>
        </tr>
 
<?php } ?>
 
      </tbody>
        </table>
 
      <h4><?php echo $results['totalRows']?> news<?php echo ( $results['totalRows'] != 1 ) ? '' : '' ?> published.
      </h4>
 
      <p><a href="articles.php?action=newArticle" type="button" class="btn btn-block btn-info">Add a news</a></p>

 
<?php include "templates/include/footer.php" ?>