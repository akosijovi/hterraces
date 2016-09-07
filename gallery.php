

<?php
 
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
 
switch ( $action ) {
  case 'archive':
    archive();
    break;
  case 'viewGallery':
    viewGallery();
    break;
	case 'galleryall':
    galleryall();
    break;
	default:gallerys();
}
 
 
 
function viewGallery() {
  if ( !isset($_GET["galleryId"]) || !$_GET["galleryId"] ) {
    homegallery();
    return;
  }
 
  $results = array();
  $results['gallery'] = Gallery::getById( (int)$_GET["galleryId"] );
  $results['galleryTitle'] = $results['gallery']->title . " | Widget News";
  require( TEMPLATE_PATH . "/viewGallery.php" );
}
 
function gallerys() {
  $results = array();
  $data = Gallery::getList( GALLERY_NUM_IMAGES );
  $results['gallerys'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['galleryTitle'] = "Widget News";
  require( TEMPLATE_PATH . "/homegallery.php" );
}

function galleryall() {
  $results = array();
  $data = Gallery::getList( GALLERY_NUM_IMAGES );
  $results['gallerys'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['galleryTitle'] = "Widget News";
  require( TEMPLATE_PATH . "/homegalleryall.php" );
}
 
?>