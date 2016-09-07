<div id="gallery"></div>
	<div class="row themeUsed">
		<div class="col-md-12">
			<div class="jumbotron">
				<h2>
					Gallery
				</h2>
				<p style="padding-top:20px;padding-left:30px">
					<div id="galleryAll"></div>
                <?php foreach ( $results['gallerys'] as $gallery ) { ?>
						<?php if ( $imagePath = $gallery->getImagePath() ) { ?> 
                        <a class="fancybox-thumbs" data-fancybox-group="thumb"  href="<?php echo $imagePath?>"><?php } ?>
                        <?php if ( $imagePath = $gallery->getImagePath( IMG_TYPE_THUMB ) ) { ?>
                        <img style="padding:5px" src="<?php echo $imagePath?>"  <?php } ?>
                         <?php if ( $imagePath = $gallery->getImagePath() ) { ?>  <?php } ?> 
                         title="<?php echo htmlspecialchars( $gallery->summary )?>"  />
                         </a>
                <?php } ?>
				</p>
                
			</div>
		</div>
	</div>