<div id="news"></div>
	<div class="row"  style="padding-top:50px">

		<div class="junbotron" style="">
		<div class="col-md-12">
			<div class="row">
                        <center><h2 style="padding-top:10px;margin-bottom:25px;height:55px;width:1200px;border:1px solid #ddd; border-radius:4px;	-webkit-transition:border .2s ease-in-out; -o-transition:border .2s ease-in-out; transition:border .2s ease-in-out; background: rgba(238, 238, 238, 0.7);">News</br></h2></center>
            <!-- start call-->
            <?php foreach ( $results['articles'] as $article ) { ?>
 
   
            
				<div class="col-md-4" >
					<div class="thumbnail">
                    <div class="item"  style="min-height:230px;">
						<?php if ( $imagePath = $article->getImagePath(  ) ) { ?>
              <a  class="fancybox fancybox.iframe"  href="news.php?action=viewArticle&amp;articleId=<?php echo $article->id?>"><img src="<?php echo $imagePath?>" class="img" alt="<?php echo htmlspecialchars( $article->title )?>" /></a>
            <?php } ?>
           			</div>
            
						<div class="caption">
							<h3 style="min-height:55px;">
							<?php echo htmlspecialchars( $article->title )?><p><span class="pubDate"><?php echo date('j F', $article->publicationDate)?></span></p>
							</h3>
							<p style="min-height:100px;">
								<?php echo htmlspecialchars( $article->summary )?>
							</p>
							<p>
								<a   href="news.php?action=viewArticle&amp;articleId=<?php echo $article->id?>" class="fancybox fancybox.iframe btn btn-primary btn-large" >Read More</a>
							</p>
						</div>
					</div>
				</div>
                <?php } ?>
				</div>
			</div>
		</div>
	</div>