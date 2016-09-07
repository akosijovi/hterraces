<?php foreach ( $results['pages'] as $page[] ) { ?>

<?php } ?>
    
<div class="col-md-12">
    <!-- about -->
    <div id="about"></div>
	<div class="row themeUsed">
	<div class="junbotron">
		<div class="col-md-5" style="">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.6452199623623!2d121.15125859999999!3d14.6192753!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b8dc558b57b9%3A0xd76873823805844a!2sHollywood+Terraces%2C+Sumulong+Hwy%2C+Antipolo%2C+Rizal!5e0!3m2!1sen!2sph!4v1429459882998" width="100%" height="400px" frameborder="0" style="border:0"></iframe>
			<p>
				<?php echo ( $page[1]->content )?>
			</p>
			<?php echo ( $page[5]->content )?>
		</div>
		<div class="col-md-7" style="">
				<h2>
					<?php echo ( $page[2]->title )?>
				</h2>
				<p >
					<?php echo ( $page[2]->content )?>
				</p>
		</div>
	</div>
   </div>
</div>