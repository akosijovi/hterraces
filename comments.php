<?php


require( "config.php" );

session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";
 
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

if ( $action != "login" && $action != "logout" && !$username ) {
  login();
  exit;
}
 
switch ( $action ) {
  case 'login':
    login();
    break;
  case 'logout':
    logout();
    break;
  case 'sendComment':
    sendComment();
    break;
  case 'newComment':
    newComment();
    break;
  case 'viewComment':
    viewComment();
    break;
  case 'deleteComment':
    deleteComment();
    break;
	case 'viewPage':
	viewPage();
	break;
  default:
    listComments();
}
 
 
function login() {
 
  $results = array();
  $results['pageTitle'] = "Admin Login | Widget News";
 
  if ( isset( $_POST['login'] ) ) {
 
    // User has posted the login form: attempt to log the user in
 
    if ( $_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD ) {
 
      // Login successful: Create a session and redirect to the comments homepage
      $_SESSION['username'] = ADMIN_USERNAME;
      header( "Location: comments.php" );
 
    } else {
 
      // Login failed: display an error message to the user
      $results['errorMessage'] = "Incorrect username or password. Please try again.";
      require( TEMPLATE_PATH . "/comments/loginForm.php" );
    }
 
  } else {
 
    // User has not posted the login form yet: display the form
    require( TEMPLATE_PATH . "/comments/loginForm.php" );
  }
 
}
 
 
function logout() {
  unset( $_SESSION['username'] );
  header( "Location: comments.php" );
}
 



 
function newComment() {
 
  $results = array();
  $results['pageTitle'] = "New Comment";
  $results['pageSent'] = "Comment Successful!";
  $results['formAction'] = "newComment";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the comment edit form: save the new comment
    $comment = new Comment;
    $comment->storeFormValues( $_POST );
    $comment->insert();
	
    header( "Location: ?status=sent" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the comment list
    header( "Location: index.php" );
  } else {
 
    // User has not posted the comment edit form yet: display the form
    $results['comment'] = new Comment;
    require( TEMPLATE_PATH . "/comments/editComment.php" );
  }
 
}
 
function sendComment() {
 
    $results = array();
  $results['pageTitle'] = "Reply to Comment";
  $results['formAction'] = "sendComment";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
	$ti=time();
	$datoday = date("Y-m-d",$ti);
	$sec = date("h:i:sa");
	
	$to      = $_POST['summary']; // Send email to our user
	$subject = $_POST['title']; // Give the email a subject 
	$y = $_POST['past'];
	$x = $_POST['content']; // Our message above including the link
	$message = "
	
	
	
	$x
	
	
	------------------------------
	
	On $datoday $sec <$to> wrote:
	
		$y
	 
	
	";			 
	$headers = 'From: admin@hollywoodterraces.com' . "\r\n"; // Set from headers
	mail($to, $subject, $message, $headers);
	
    header( "Location: ?status=commentSent" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the comment list
    header( "Location: index.php" );
  } else {
 
    // User has not posted the comment edit form yet: display the form
    $results['comment'] = Comment::getById( (int)$_GET['commentId'] );
    require( TEMPLATE_PATH . "/comments/sendComment.php" );
  }
 
}

 
function viewComment() {if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}else{
 if ( !isset($_GET["commentId"]) || !$_GET["commentId"] ) {
    homepage();
    return;
  }
 
  $results = array();
  $data = Comment::getList();
  $results['comment'] = Comment::getById( (int)$_GET["commentId"] );
  $results['commentTitle'] = $results['comment']->title . " | Widget News";
  require( TEMPLATE_PATH . "/viewComment.php" );
  }}

 
 
function deleteComment() {if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}else{
 
  if ( !$comment = Comment::getById( (int)$_GET['commentId'] ) ) {
    header( "Location: comments.php?error=commentNotFound" );
    return;
  }
 
  $comment->delete();
  header( "Location: comments.php?status=commentDeleted" );
}}
 
 
function listComments() {if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}else{
  $results = array();
  $data = Comment::getList();
  $results['comments'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "All Comments";
 
  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "commentNotFound" ) $results['errorMessage'] = "Error: Comment not found.";
  }
 
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "commentDeleted" ) $results['statusMessage'] = "Comment deleted.";
  }
 
  require( TEMPLATE_PATH . "/comments/listComments.php" );
}}
 
 function viewPage() {if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}else{
  if ( !isset($_GET["pageId"]) || !$_GET["pageId"] ) {
    homepage();
    return;
  }
 
  $results = array();
  $data = Page::getList();
  $results['page'] = Page::getById( (int)$_GET["pageId"] );
  $results['pageTitle'] = $results['page']->title . " | Widget News";
  require( TEMPLATE_PATH . "/viewPage.php" );
}}



function homepage() {if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}else{
  $results = array();
  $data = Page::getList( HOMEPAGE_NUM_ARTICLES );
  $results['pages'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Widget News";
  require( TEMPLATE_PATH . "/homepage.php" );
}
 }
?>