<?php include "templates/include/loginheader.php" ?>
 
      <form action="admin.php?action=login" method="post" style="width: 95%;">
        <input type="hidden" name="login" value="true" />
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul>
 
          <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control"   type="text" name="username" id="username" placeholder="Your admin username" required autofocus maxlength="20" />
          </div>
 
          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control"   type="password" name="password" id="password" placeholder="Your admin password" required maxlength="20" />
          </div>
 
        </ul>
 
        <div class="buttons" style="padding-left:90%">
          <input class="btn btn-default" type="submit" name="login" value="Login" />
        </div>
 
      </form>
 
<?php include "templates/include/loginfooter.php" ?>