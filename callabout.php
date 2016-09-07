

<?php
 
 
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
 
switch ( $action ) {
	default:about();
}
 


 
function about() {
  $results = array();
  $data = Page::getList( HOMEPAGE_NUM_ARTICLES );
  $results['pages'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Widget News";
  require( TEMPLATE_PATH . "/homeabout.php" );
}
 
?>