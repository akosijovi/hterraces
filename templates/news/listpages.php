<?php include "templates/include/header.php" ?>
 
      <div id="newsHeader">
        <h2>Welcome</h2>
        <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="news.php?action=logout"?>Log out</a> | <a href="comments.php"?>Comments</a> | <a href="news.php"?>News</a></p>
      </div>


      <h1>All Pages</h1>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
 
<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>
 
      <table cellpadding = "10px" border=1>
        <tr>
          <th>Page</th>
          <th>Summary</th>
        </tr>
 
<?php foreach ( $results['pages'] as $page ) { ?>
 
        <tr onclick="location='news.php?action=editPage&amp;pageId=<?php echo $page->id?>'">
          <td><?php echo $page->title?></td>
          <td>
            <?php echo $page->summary?>
          </td>
        </tr>
 
<?php } ?>
 
      </table>
 
      <p><?php echo $results['totalRows']?> page<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>
 
      <p><a href="news.php?action=newPage">Add a New Page</a></p>
 
 
<?php include "templates/include/footer.php" ?>