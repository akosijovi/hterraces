<tr onclick="location='comments.php?action=viewComment&amp;commentId=<?php echo $comment->id?>'">
          <td><?php echo date('j M Y', $comment->publicationDate)?></td>
          <td>
            <?php echo $comment->title?>
          </td>
        </tr>