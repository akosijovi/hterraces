<?php
 
 
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
 
switch ( $action ) {
case 'newsall':
    newsall();
break;
  case 'archive':
    archive();
    break;
  case 'viewArticle':
    viewArticle();
    break;
	default:articles();
}
 
 
function archive() {
  $results = array();
  $data = Article::getList();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['articleTitle'] = "Article Archive | Widget News";
  require( TEMPLATE_PATH . "/archive.php" );
}
 
function viewArticle() {
  if ( !isset($_GET["articleId"]) || !$_GET["articleId"] ) {
    homearticle();
    return;
  }
 
  $results = array();
  $results['article'] = Article::getById( (int)$_GET["articleId"] );
  $results['articleTitle'] = $results['article']->title . " | Widget News";
  require( TEMPLATE_PATH . "/viewArticle.php" );
}
 
function articles() {
  $results = array();
  $data = Article::getList( HOMEPAGE_NUM_ARTICLES );
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['articleTitle'] = "Widget News";
  require( TEMPLATE_PATH . "/homenews.php" );
}


function newsall() {
  $results = array();
  $data = Article::getList( HOMEPAGE_NUM_ARTICLES );
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['articleTitle'] = "Widget News";
  require( TEMPLATE_PATH . "/homenewsall.php" );
}
 
?>