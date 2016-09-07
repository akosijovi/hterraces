<?php include "templates/include/header.php" ?>
 
      <div id="newsHeader">
        <h2>Welcome</h2>
        <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="news.php?action=logout"?>Log out</a> | <a href="comments.php"?>Comments</a> | <a href="news.php"?>News</a></p>
      </div>


      <h1>All Newss</h1>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
 
<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>
 
      <table cellpadding = "10px" border=1>
        <tr>
          <th>News</th>
          <th>Summary</th>
        </tr>
 
<?php foreach ( $results['newss'] as $news ) { ?>
 
        <tr onclick="location='news.php?action=editNews&amp;newsId=<?php echo $news->id?>'">
          <td><?php echo $news->title?></td>
          <td>
            <?php echo $news->summary?>
          </td>
        </tr>
 
<?php } ?>
 
      </table>
 
      <p><?php echo $results['totalRows']?> news<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>
 
      <p><a href="news.php?action=newNews">Add a New News</a></p>
 
 
<?php include "templates/include/footer.php" ?>