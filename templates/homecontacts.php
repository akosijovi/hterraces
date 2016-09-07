<?php foreach ( $results['pages'] as $page[] ) { ?>

<?php } ?>
<div class="col-md-12">
    <!-- contact -->
    <div id="contact"></div>
	<div class="row themeUsed"  style=" padding-top:10px; padding-bottom:50px ;border:0px solid #eeeeee;">
	<div class="jumbotron">
		<div class="col-md-1">
		</div>
		<div class="col-md-5">
			<h2>
				<?php echo ( $page[4]->title )?>
			</h2>
			<?php comment()?>
		</div>
		<div class="col-md-1">
		</div>
		<div class="col-md-4">
			 
			<address style="padding-top:55px">
				<p><?php echo ( $page[4]->content )?></p>
			</address>
		</div>
        <div class="col-md-1">
		</div>
	</div>
	</div>
</div>