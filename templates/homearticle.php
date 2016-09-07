<?php include "templates/include/homepage_header.php" ?>
 
	

<?php foreach ( $results['articles'] as $article[] ) { ?>
 
       
        
<?php } ?>
 
          <p class="summary"><?php echo ( $article[0]->content )?></p>

		<h1>
            <center>
                <?php
                    $homepage = "/comments.php";
                    $currentpage = $_SERVER['REQUEST_URI'];
                    if($homepage==$currentpage) {
                    echo "<p>Not logged in!!!</p>"	;
                    }
                ?>
            </center>
        </h1>
<?php include "templates/include/footer.php" ?>