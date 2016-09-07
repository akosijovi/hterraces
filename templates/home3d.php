<?php foreach ( $results['pages'] as $page[] ) { ?>

<?php } ?>
&nbsp;</br>&nbsp;</br>
<div id="3d"></div>

			<div class="jumbotron text-center">
				 <h2 style="margin-left:25%;margin-right:25%;">
					<?php echo ( $page[3]->title )?>
				</h2>
				<p style="margin-left:25%;margin-right:25%;">
					<?php echo ( $page[3]->content )?>
				</p>
				<p>
					<center><a   href="../3d/3d.html" class="btn btn-primary btn-large"  onclick="PopupCenter('../3d/3d.html', 'Hollywood Terraces - Virtual Tour', '1100', '1000'); return false;" >View the Virtual Tour</a></center>
				</p>
			</div>