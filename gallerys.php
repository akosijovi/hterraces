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
  case 'newGallery':
    newGallery();
    break;
  case 'editGallery':
    editGallery();
    break;
  case 'deleteGallery':
    deleteGallery();
    break;
  default:
    listGallerys();
}
 
 
function login() {
 
  $results = array();
  $results['pageTitle'] = "Admin Login | Widget News";
 
  if ( isset( $_POST['login'] ) ) {
 
    // User has posted the login form: attempt to log the user in
 
    if ( $_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD ) {
 
      // Login successful: Create a session and redirect to the admin homepage
      $_SESSION['username'] = ADMIN_USERNAME;
      header( "Location: gallerys.php" );
 
    } else {
 
      // Login failed: display an error message to the user
      $results['errorMessage'] = "Incorrect username or password. Please try again.";
      require( TEMPLATE_PATH . "/admin/loginForm.php" );
    }
 
  } else {
 
    // User has not posted the login form yet: display the form
    require( TEMPLATE_PATH . "/admin/loginForm.php" );
  }
 
}
 
 
function logout() {
  unset( $_SESSION['username'] );
  header( "Location: gallerys.php" );
}
 
 
function newGallery() {
 
  $results = array();
  $results['pageTitle'] = "New Gallery";
  $results['formAction'] = "newGallery";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the gallery edit form: save the new gallery
    $gallery = new Gallery;
    $gallery->storeFormValues( $_POST );
    $gallery->insert();
    if ( isset( $_FILES['image'] ) ) $gallery->storeUploadedImage( $_FILES['image'] );
    header( "Location: gallerys.php?status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the gallery list
    header( "Location: gallerys.php" );
  } else {
 
    // User has not posted the gallery edit form yet: display the form
    $results['gallery'] = new Gallery;
    require( TEMPLATE_PATH . "/admin/editGallery.php" );
  }
 
}
 
 
function editGallery() {
 
  $results = array();
  $results['pageTitle'] = "Edit Gallery";
  $results['formAction'] = "editGallery";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the gallery edit form: save the gallery changes
 
    if ( !$gallery = Gallery::getById( (int)$_POST['galleryId'] ) ) {
      header( "Location: gallerys.php?error=galleryNotFound" );
      return;
    }
 
    $gallery->storeFormValues( $_POST );
    if ( isset($_POST['deleteImage']) && $_POST['deleteImage'] == "yes" ) $gallery->deleteImages();
    $gallery->update();
    if ( isset( $_FILES['image'] ) ) $gallery->storeUploadedImage( $_FILES['image'] );
    header( "Location: gallerys.php?status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the gallery list
    header( "Location: gallerys.php" );
  } else {
 
    // User has not posted the gallery edit form yet: display the form
    $results['gallery'] = Gallery::getById( (int)$_GET['galleryId'] );
    require( TEMPLATE_PATH . "/admin/editGallery.php" );
  }
 
}
 
 
function deleteGallery() {
 
  if ( !$gallery = Gallery::getById( (int)$_GET['galleryId'] ) ) {
    header( "Location: gallerys.php?error=galleryNotFound" );
    return;
  }
 
  $gallery->deleteImages();
  $gallery->delete();
  header( "Location: gallerys.php?status=galleryDeleted" );
}
 
 
function listGallerys() {
  $results = array();
  $data = Gallery::getList();
  $results['gallerys'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "All Gallerys";
 
  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "galleryNotFound" ) $results['errorMessage'] = "Error: Gallery not found.";
  }
 
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "galleryDeleted" ) $results['statusMessage'] = "Gallery deleted.";
  }
 
  require( TEMPLATE_PATH . "/admin/listGallerys.php" );
}
 
?>