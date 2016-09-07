<?php include "templates/include/header.php" ?>
 
      <?php
         
           $link =  mysqli_connect("sql6.freemysqlhosting.net", "sql6134728", "xGTEF6YqgD", "sql6134728");
             if(isset($_GET['name']) && !empty($_GET['name']) AND isset($_GET['value']) && !empty($_GET['value'])){
    // Verify data
	$name = $_GET['name'];
    $value =$_GET['value'];
	$col   =$_GET['col'];// Set value variable       

    $search = mysqli_query($link,"SELECT name, value FROM themes WHERE name='".$name."'");
    $match  = $search->num_rows;

    if($match > 0){
        // We have a match, activate the account
       mysqli_query($link, "UPDATE themes SET value='".$value."' WHERE name='".$name."' col ='".$col."' ");
        echo '<div class="alert alert-dismissable alert-info">Changes have been saved.</div>';
    }else{
        // No match -> invalid url or account has already been activated.
        echo '<div class="alert alert-dismissable alert-info">Something went wrong. Try again in a little while.</div>';
    }
                 
}else{
    // Invalid approach
    echo '<div class="alert alert-dismissable alert-info">Invalid approach, please use the link that has been sent to your name.</div>';
}
        ?>
 
<?php include "templates/include/footer.php" ?>