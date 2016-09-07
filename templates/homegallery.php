<div id="gallery"></div>
	<div class="row themeUsed">
		<div class="col-md-12">
			<div class="jumbotron text-center">
				<h2>
					Gallery
				</h2>
				<p style="">
				 <?php $i = 0; ?>
					<div id="galleryAll"></div>
                <?php foreach ( $results['gallerys'] as $gallery ) { ?>
						<?php if ( $imagePath = $gallery->getImagePath() ) { ?> 
                        <a class="fancybox-thumbs" data-fancybox-group="thumb"  href="<?php echo $imagePath?>"><?php } ?>
                        <?php if ( $imagePath = $gallery->getImagePath( IMG_TYPE_THUMB ) ) { ?>
                        <img style="padding:5px" src="<?php echo $imagePath?>"  <?php } ?>
                         <?php if ( $imagePath = $gallery->getImagePath() ) { ?>  <?php } ?> 
                         title="<?php echo htmlspecialchars( $gallery->summary )?>"  />
                         </a>
						 
						 <?php 
						 if (++$i == 6)
						 break;
						 ?>
						 
                <?php } ?>
				
				<p>
						</br><center><a  id="fancybox-manual-b" class="btn btn-primary btn-large" href="?action=galleryall#galleryAll" >View more</a></center>
				
				</p>
                
			</div>
		</div>
	</div>