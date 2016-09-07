<?php $countme+=1;?>
        <tr onclick="location='users.php?action=editUsers&amp;userId=<?php echo $users->id?>'">
          <td><?php echo $users->username?></td>
          <td>
            <?php echo $users->active?>
          </td>
        </tr>