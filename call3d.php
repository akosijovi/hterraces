<?php
 
 
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
 
switch ( $action ) {
	default:virt();
}
 


 
function virt() {
  $results = array();
  $data = Page::getList( HOMEPAGE_NUM_ARTICLES );
  $results['pages'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Widget News";
  require( TEMPLATE_PATH . "/home3d.php" );
}
 
?>