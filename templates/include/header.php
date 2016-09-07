<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HT - Administrator Panel</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min2.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body style="background-color:#09F; padding-top:25px">
<center><a href="index.php" ><img src="images/logo.png"/></a></center>
    <div class="container-fluid" style="padding-top:25px;">
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron">
			<div class="row">
				<div class="col-md-3" style="padding-top:45px;">
				
        <h4>You are logged in as <b>
		<?php $name = htmlspecialchars( $_SESSION['username']); echo $name ?></b>.</h4>
      	
		<?php  $link =  mysqli_connect("sql6.freemysqlhosting.net", "sql6134728", "xGTEF6YqgD", "sql6134728");
		$search = mysqli_query($link,"SELECT username, page FROM users WHERE username='".$name."' and page = 1 ");
		$match  = $search->num_rows; 
		if($match > 0){ ?>    
			<a href="admin.php" type="button" class="btn btn-block btn-info">
				Pages
			</a>
		<?php } ?>	
		<?php $search = mysqli_query($link,"SELECT username, gallery FROM users WHERE username='".$name."' and gallery = 1 ");
		$match  = $search->num_rows; 
		if($match > 0){ ?>  	
            <a href="gallerys.php" type="button" class="btn btn-block btn-info">
				Gallery
			</a>
		<?php } ?>	
		<?php $search = mysqli_query($link,"SELECT username, news FROM users WHERE username='".$name."' and news = 1 ");
		$match  = $search->num_rows; 
		if($match > 0){ ?>  
            <a href="articles.php" type="button" class="btn btn-block btn-info">
				News
			</a>
		<?php } ?>	
		<?php $search = mysqli_query($link,"SELECT username, comments FROM users WHERE username='".$name."' and comments = 1 ");
		$match  = $search->num_rows; 
		if($match > 0){ ?>  
            <a href="comments.php" type="button" class="btn btn-block btn-info">
				Inbox
			</a>
		<?php } ?>	
            <a href="users.php" type="button" class="btn btn-block btn-info">
				Users
			</a>
		<?php $search = mysqli_query($link,"SELECT username, themes FROM users WHERE username='".$name."' and themes = 1 ");
		$match  = $search->num_rows; 
		if($match > 0){ ?>  
			<a href="themes.php" type="button" class="btn btn-block btn-info">
				Themes
			</a>
		<?php } ?>	
			<a href="track.php" type="button" class="btn btn-block btn-info">
				Track Views
			</a>
            <a href="admin.php?action=logout" type="button" class="btn btn-block btn-info">
				Logout
			</a>
</div>
			
				<div class="col-md-9" style="padding-left:50px;">