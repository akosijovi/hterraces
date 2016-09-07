<?php
 
  session_start();
  if (!$_SESSION['status']) {
    $link =  mysqli_connect("sql6.freemysqlhosting.net", "sql6134728", "xGTEF6YqgD", "sql6134728");

    $ip = $_SERVER['REMOTE_ADDR'];
    $search = mysqli_query($link,"INSERT INTO ip (IP) VALUES ('$ip')");

	mysqli_close($link);
    $_SESSION['status'] = true;
  }
 
require( "config.php" );
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
 
switch ( $action ) {
  case 'archive':
    archive();
    break;

  case 'viewPage':
    viewPage();
    break;
  default:
    homepage();
}
 

 
function viewPage() {
  if ( !isset($_GET["pageId"]) || !$_GET["pageId"] ) {
    homepage();
    return;
  }
 
  $results = array();
  $results['page'] = Page::getById( (int)$_GET["pageId"] );
  $results['pageTitle'] = $results['page']->title . " | Widget News";
  require( TEMPLATE_PATH . "/viewPage.php" );
}
 
function homepage() {
  $results = array();
  $data = Page::getList( HOMEPAGE_NUM_ARTICLES );
  $results['pages'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Widget News";
  require( TEMPLATE_PATH . "/homepage.php" );
}

function contactus() {
  $results = array();
  $data = Page::getList( HOMEPAGE_NUM_ARTICLES );
  $results['pages'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Widget News";
  require( TEMPLATE_PATH . "/homecontacts.php" );
}

function comment() { 
  $results = array();
  $results['pageTitle'] = "Add a New Comment";
  
  $results['formAction'] = "newComment";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the comment edit form: save the new comment
    $comment = new Comment;
    $comment->storeFormValues( $_POST );
    $comment->insert();
	$results['pageSent'] = "Comment Successful!";
    header( "Location: ?status=commentSent" );
 
  } 
 else {
 
    // User has not posted the comment edit form yet: display the form
    $results['comment'] = new Comment;
    require( TEMPLATE_PATH . "/comments/addComment.php" );
  }
}


function virtual() {
  $results = array();
  $data = Article::getList( HOMEPAGE_NUM_ARTICLES );
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['articleTitle'] = "Widget News";
  require( TEMPLATE_PATH . "/home3d.php" );
}
 
?>