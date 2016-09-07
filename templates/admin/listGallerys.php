<?php include "templates/include/header.php" ?>
 


      <h2>Gallery</h2>
 
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
							Image
						</th>
						<th>
							Description
						</th>
					</tr>
				</thead>
 			<tbody>
 
<?php foreach ( $results['gallerys'] as $gallery ) { ?>
 
        <tr onclick="location='gallerys.php?action=editGallery&amp;galleryId=<?php echo $gallery->id?>'">
        <?php if ( $imagePath = $gallery->getImagePath( IMG_TYPE_THUMB ) ) { ?>
          <td><img class="galleryImageThumb" src="<?php echo $imagePath?>" alt="Image Thumbnail" /></td>
           <?php } ?>
          <td >
            <?php echo $gallery->summary?>
          </td>
        </tr>
 
<?php } ?>
 
                </tbody>
        </table>
 
      <h4><?php echo $results['totalRows']?> image<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> uploaded.</h4>
 
      <p><a href="gallerys.php?action=newGallery" type="button" class="btn btn-block btn-info">Add a picture</a></p>
 
 
<?php include "templates/include/footer.php" ?>