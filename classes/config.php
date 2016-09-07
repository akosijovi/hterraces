<?php
ini_set( "display_errors", true );
date_default_timezone_set( "Asia/Singapore" );  // http://www.php.net/manual/en/timezones.php
define( "DB_DSN", "mysql:host=sql6.freemysqlhosting.net;dbname=sql6134728" );
define( "DB_USERNAME", "sql6134728" );
define( "DB_PASSWORD", "xGTEF6YqgD" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "HOMEPAGE_NUM_ARTICLES", 8 );
define( "GALLERY_NUM_IMAGES", 1000 );
define( "ADMIN_USERNAME", "admin" );
define( "ADMIN_PASSWORD", "password" );
define( "ARTICLE_IMAGE_PATH", "images/articles" );
define( "GALLERY_IMAGE_PATH", "images/gallery" );
define( "IMG_TYPE_FULLSIZE", "fullsize" );
define( "IMG_TYPE_THUMB", "thumb" );
define( "ARTICLE_THUMB_WIDTH", 120 );
define( "GALLERY_THUMB_WIDTH", 320 );
define( "JPEG_QUALITY", 85 );
require( CLASS_PATH . "/Page.php" );
require( CLASS_PATH . "/Article.php" );
require( CLASS_PATH . "/Comment.php" );
require( CLASS_PATH . "/Gallery.php" );
require( CLASS_PATH . "/Themes.php" );
require( CLASS_PATH . "/User.php" );

?>


