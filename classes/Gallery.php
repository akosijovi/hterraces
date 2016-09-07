<?php
 
/**
 * Class to handle gallerys
 */
 
class Gallery
{
  // Properties
 
  /**
  * @var int The gallery ID from the database
  */
  public $id = null;
 
  /**
  * @var int When the gallery is to be / was first published
  */
  public $publicationDate = null;
 
  /**
  * @var string Full title of the gallery
  */
  public $title = null;
 
  /**
  * @var string A short summary of the gallery
  */
  public $summary = null;
 
  /**
  * @var string The HTML content of the gallery
  */
  public $content = null;
 
  /**
  * @var string The filename extension of the gallery's full-size and thumbnail images (empty string means the gallery has no image)
  */
  public $imageExtension = "";
 
 
  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
 
  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['publicationDate'] ) ) $this->publicationDate = (int) $data['publicationDate'];
    if ( isset( $data['title'] ) ) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title'] );
    if ( isset( $data['summary'] ) ) $this->summary = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['summary'] );
    if ( isset( $data['content'] ) ) $this->content = $data['content'];
    if ( isset( $data['imageExtension'] ) ) $this->imageExtension = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\$ a-zA-Z0-9()]/", "", $data['imageExtension'] );
  }
 
 
  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */
 
  public function storeFormValues( $params ) {
 
    // Store all the parameters
    $this->__construct( $params );
 
    // Parse and store the publication date
    if ( isset($params['publicationDate']) ) {
      $publicationDate = explode ( '-', $params['publicationDate'] );
 
      if ( count($publicationDate) == 3 ) {
        list ( $y, $m, $d ) = $publicationDate;
        $this->publicationDate = mktime ( 0, 0, 0, $m, $d, $y );
      }
    }
  }
 
 
  /**
  * Stores any image uploaded from the edit form
  *
  * @param assoc The 'image' element from the $_FILES array containing the file upload data
  */
 
  public function storeUploadedImage( $image ) {
 
    if ( $image['error'] == UPLOAD_ERR_OK )
    {
      // Does the Gallery object have an ID?
      if ( is_null( $this->id ) ) trigger_error( "Gallery::storeUploadedImage(): Attempt to upload an image for an Gallery object that does not have its ID property set.", E_USER_ERROR );
 
      // Delete any previous image(s) for this gallery
      $this->deleteImages();
 
      // Get and store the image filename extension
      $this->imageExtension = strtolower( strrchr( $image['name'], '.' ) );
 
      // Store the image
 
      $tempFilename = trim( $image['tmp_name'] ); 
 
      if ( is_uploaded_file ( $tempFilename ) ) {
        if ( !( move_uploaded_file( $tempFilename, $this->getImagePath() ) ) ) trigger_error( "Gallery::storeUploadedImage(): Couldn't move uploaded file.", E_USER_ERROR );
        if ( !( chmod( $this->getImagePath(), 0666 ) ) ) trigger_error( "Gallery::storeUploadedImage(): Couldn't set permissions on uploaded file.", E_USER_ERROR );
      }
 
      // Get the image size and type
      $attrs = getimagesize ( $this->getImagePath() );
      $imageWidth = $attrs[0];
      $imageHeight = $attrs[1];
      $imageType = $attrs[2];
 
      // Load the image into memory
      switch ( $imageType ) {
        case IMAGETYPE_GIF:
          $imageResource = imagecreatefromgif ( $this->getImagePath() );
          break;
        case IMAGETYPE_JPEG:
          $imageResource = imagecreatefromjpeg ( $this->getImagePath() );
          break;
        case IMAGETYPE_PNG:
          $imageResource = imagecreatefrompng ( $this->getImagePath() );
          break;
        default:
          trigger_error ( "Gallery::storeUploadedImage(): Unhandled or unknown image type ($imageType)", E_USER_ERROR );
      }
 
      // Copy and resize the image to create the thumbnail
      $thumbHeight = intval ( $imageHeight / $imageWidth * GALLERY_THUMB_WIDTH );
      $thumbResource = imagecreatetruecolor ( GALLERY_THUMB_WIDTH, $thumbHeight );
      imagecopyresampled( $thumbResource, $imageResource, 0, 0, 0, 0, GALLERY_THUMB_WIDTH, $thumbHeight, $imageWidth, $imageHeight );
 
      // Save the thumbnail
      switch ( $imageType ) {
        case IMAGETYPE_GIF:
          imagegif ( $thumbResource, $this->getImagePath( IMG_TYPE_THUMB ) );
          break;
        case IMAGETYPE_JPEG:
          imagejpeg ( $thumbResource, $this->getImagePath( IMG_TYPE_THUMB ), JPEG_QUALITY );
          break;
        case IMAGETYPE_PNG:
          imagepng ( $thumbResource, $this->getImagePath( IMG_TYPE_THUMB ) );
          break;
        default:
          trigger_error ( "Gallery::storeUploadedImage(): Unhandled or unknown image type ($imageType)", E_USER_ERROR );
      }
 
      $this->update();
    }
  }
 
 
  /**
  * Deletes any images and/or thumbnails associated with the gallery
  */
 
  public function deleteImages() {
 
    // Delete all fullsize images for this gallery
    foreach (glob( GALLERY_IMAGE_PATH . "/" . IMG_TYPE_FULLSIZE . "/" . $this->id . ".*") as $filename) {
      if ( !unlink( $filename ) ) trigger_error( "Gallery::deleteImages(): Couldn't delete image file.", E_USER_ERROR );
    }
     
    // Delete all thumbnail images for this gallery
    foreach (glob( GALLERY_IMAGE_PATH . "/" . IMG_TYPE_THUMB . "/" . $this->id . ".*") as $filename) {
      if ( !unlink( $filename ) ) trigger_error( "Gallery::deleteImages(): Couldn't delete thumbnail file.", E_USER_ERROR );
    }
 
    // Remove the image filename extension from the object
    $this->imageExtension = "";
  }
 
 
  /**
  * Returns the relative path to the gallery's full-size or thumbnail image
  *
  * @param string The type of image path to retrieve (IMG_TYPE_FULLSIZE or IMG_TYPE_THUMB). Defaults to IMG_TYPE_FULLSIZE.
  * @return string|false The image's path, or false if an image hasn't been uploaded
  */
 
  public function getImagePath( $type=IMG_TYPE_FULLSIZE ) {
    return ( $this->id && $this->imageExtension ) ? ( GALLERY_IMAGE_PATH . "/$type/" . $this->id . $this->imageExtension ) : false;
  }
 
 
  /**
  * Returns an Gallery object matching the given gallery ID
  *
  * @param int The gallery ID
  * @return Gallery|false The gallery object, or false if the record was not found or there was a problem
  */
 
  public static function getById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM gallerys WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Gallery( $row );
  }
 
 
  /**
  * Returns all (or a range of) Gallery objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the gallerys (default="publicationDate DESC")
  * @return Array|false A two-element array : results => array, a list of Gallery objects; totalRows => Total number of gallerys
  */
 
  public static function getList( $numRows=1000000, $order="publicationDate DESC" ) {
	$link = mysqli_connect("sql6.freemysqlhosting.net", "sql6134728", "xGTEF6YqgD", "sql6134728");
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM gallerys
            ORDER BY " . mysqli_real_escape_string ($link ,$order ) . " LIMIT :numRows";
 
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();
 
    while ( $row = $st->fetch() ) {
      $gallery = new Gallery( $row );
      $list[] = $gallery;
    }
 
    // Now get the total number of gallerys that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }
 
 
  /**
  * Inserts the current Gallery object into the database, and sets its ID property.
  */
 
  public function insert() {
 
    // Does the Gallery object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Gallery::insert(): Attempt to insert an Gallery object that already has its ID property set (to $this->id).", E_USER_ERROR );
 
    // Insert the Gallery
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO gallerys ( publicationDate, title, summary, content, imageExtension ) VALUES ( FROM_UNIXTIME(:publicationDate), :title, :summary, :content, :imageExtension )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":imageExtension", $this->imageExtension, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }
 
 
  /**
  * Updates the current Gallery object in the database.
  */
 
  public function update() {
 
    // Does the Gallery object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Gallery::update(): Attempt to update an Gallery object that does not have its ID property set.", E_USER_ERROR );
    
    // Update the Gallery
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE gallerys SET publicationDate=FROM_UNIXTIME(:publicationDate), title=:title, summary=:summary, content=:content, imageExtension=:imageExtension WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":imageExtension", $this->imageExtension, PDO::PARAM_STR );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
 
  /**
  * Deletes the current Gallery object from the database.
  */
 
  public function delete() {
 
    // Does the Gallery object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Gallery::delete(): Attempt to delete an Gallery object that does not have its ID property set.", E_USER_ERROR );
 
    // Delete the Gallery
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM gallerys WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
}
 
?>