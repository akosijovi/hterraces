<?php
 
require( "config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

         

$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";


 
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
  case 'newPage':
    newPage();
    break;
  case 'editPage':
    editPage();
    break;
  case 'deletePage':
    deletePage();
    break;
	case 'viewPage':
	viewPage();
	break;
  default:
    listPages();
}
 
 
function login() {
  $link =  mysqli_connect("sql6.freemysqlhosting.net", "sql6134728", "xGTEF6YqgD", "sql6134728");
  $results = array();
  $results['pageTitle'] = "Admin Login | Widget News";
 
  if ( isset( $_POST['login'] ) ) {
 
    // User has posted the login form: attempt to log the user in
 

if(isset($_POST['username']) && !empty($_POST['username']) AND isset($_POST['password']) && !empty($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $search = mysqli_query($link,"SELECT username, password, active FROM users WHERE username='".$username."' AND password='".$password."' AND active='1'"); 
    $match  = $search->num_rows;
}


    if($match > 0){
 
      // Login successful: Create a session and redirect to the admin homepage
      $_SESSION['username'] = $username;
      header( "Location: admin.php" );
 
    } else {
	 // Login failed: display an error message to the user
      $results['errorMessage'] = "Incorrect username or password. Please try again";
      require( TEMPLATE_PATH . "/admin/loginForm.php" );

    }
 
  } else {
 
    // User has not posted the login form yet: display the form
    require( TEMPLATE_PATH . "/admin/loginForm.php" );
  }
 
}
 
 
function logout() {
  unset( $_SESSION['username'] );
  header( "Location: admin.php" );
}
 
 
function newPage() {
 if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}else{
  $results = array();
  $results['pageTitle'] = "New Page";
  $results['formAction'] = "newPage";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the page edit form: save the new page
    $page = new Page;
    $page->storeFormValues( $_POST );
    $page->insert();
    header( "Location: admin.php?status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the page list
    header( "Location: admin.php" );
  } else {
 
    // User has not posted the page edit form yet: display the form
    $results['page'] = new Page;
    require( TEMPLATE_PATH . "/admin/editPage.php" );
  }
 }
}
 
 
function editPage() {if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}else{
 
  $results = array();
  $results['pageTitle'] = "Edit Page";
  $results['formAction'] = "editPage";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the page edit form: save the page changes
 
    if ( !$page = Page::getById( (int)$_POST['pageId'] ) ) {
      header( "Location: admin.php?error=pageNotFound" );
      return;
    }
 
    $page->storeFormValues( $_POST );
    $page->update();
    header( "Location: admin.php?status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the page list
    header( "Location: admin.php" );
  } else {
 
    // User has not posted the page edit form yet: display the form
    $results['page'] = Page::getById( (int)$_GET['pageId'] );
    require( TEMPLATE_PATH . "/admin/editPage.php" );
  }
 }
}
 
 
function deletePage() {
 
  if ( !$page = Page::getById( (int)$_GET['pageId'] ) ) {
    header( "Location: admin.php?error=pageNotFound" );
    return;
  }
 
  $page->delete();
  header( "Location: admin.php?status=pageDeleted" );
}
 
 
function listPages() {if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}else{
  $results = array();
  $data = Page::getList();
  $results['pages'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "All Pages";
 
  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "pageNotFound" ) $results['errorMessage'] = "Error: Page not found.";
  }
 
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "pageDeleted" ) $results['statusMessage'] = "Page deleted.";
  }
 
  require( TEMPLATE_PATH . "/admin/listPages.php" );}
}

function viewPage() {
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
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
  require( TEMPLATE_PATH . "/viewPage.php" );}
}
 

?>