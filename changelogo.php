<?php include "templates/include/header.php" ?>
 
      <?php
         
           $link =  mysqli_connect("mysql.hostinger.ph", "u392575147_admin", "W23o15o15d4", "u392575147_cms");
             if(isset($_GET['name']) && !empty($_GET['name']) AND isset($_GET['value']) && !empty($_GET['value'])){
    // Verify data
	$name = $_GET['name'];
    $value =$_GET['value'];   

    $search = mysqli_query($link,"SELECT name, value FROM themes WHERE name='".$name."'");
    $match  = $search->num_rows;

    if($match > 0){
        // We have a match, activate the account
       mysqli_query($link, "UPDATE themes SET value='".$value."' WHERE name='".$name."' ");
        echo '<div class="alert alert-dismissable alert-info">Changes have been saved.</div>';
    }else{
        // No match -> invalid url or account has already been activated.
        echo '<div class="alert alert-dismissable alert-info">Something went wrong. Try again in a little while.</div>';
    }
                 
}else{
    // Invalid approach
    
	
	echo '
	<img src="images/logo.png">
	<form enctype="multipart/form-data" method="post" action="image_upload_script.php">
			Choose your image here:
			<input name="uploaded_file" type="file"/><br /><br />
			<input type="submit" value="Upload It"/>
			</form>';
}
        ?>
 
<?php include "templates/include/footer.php" ?>