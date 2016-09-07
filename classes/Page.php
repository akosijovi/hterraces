<?php

 
/**
 * Class to handle pages
 */

class Page
{
 
  // Properties
 
  /**
  * @var int The page ID from the database
  */
  public $id = null;
 
  /**
  * @var int When the page was published
  */
  public $latestDate = null;
 
  /**
  * @var string Full title of the page
  */
  public $title = null;
 
  /**
  * @var string A short summary of the page
  */
  public $summary = null;
 
  /**
  * @var string The HTML content of the page
  */
  public $content = null;
 
 
  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
 
  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['latestDate'] ) ) $this->latestDate = (int) $data['latestDate'];
    if ( isset( $data['title'] ) ) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title'] );
    if ( isset( $data['summary'] ) ) $this->summary = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['summary'] );
    if ( isset( $data['content'] ) ) $this->content = $data['content'];
  }
 
 
  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */
 
  public function storeFormValues ( $params ) {
 
    // Store all the parameters
    $this->__construct( $params );
 
    // Parse and store the publication date
    if ( isset($params['latestDate']) ) {
      $latestDate = explode ( '-', $params['latestDate'] );
 
      if ( count($latestDate) == 3 ) {
        list ( $y, $m, $d ) = $latestDate;
        $this->latestDate = mktime ( 0, 0, 0, $m, $d, $y );
      }
    }
  }
 
 
  /**
  * Returns an Page object matching the given page ID
  *
  * @param int The page ID
  * @return Page|false The page object, or false if the record was not found or there was a problem
  */
 
  public static function getById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT *, UNIX_TIMESTAMP(latestDate) AS latestDate FROM pages WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Page( $row );
  }
 
 
  /**
  * Returns all (or a range of) Page objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the pages (default="latestDate DESC")
  * @return Array|false A two-element array : results => array, a list of Page objects; totalRows => Total number of pages
  */
 
  public static function getList( $numRows=1000000, $order="id ASC" ) {
    $link = mysqli_connect("mysql.hostinger.ph", "u392575147_lo", "W23o15o15d4", "u392575147_samp");
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(latestDate) AS latestDate FROM pages
            ORDER BY " . mysqli_real_escape_string ($link ,$order ) . " LIMIT :numRows";
 
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();
 
    while ( $row = $st->fetch() ) {
      $page = new Page( $row );
      $list[] = $page;
    }
 
    // Now get the total number of pages that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }
 
 
  /**
  * Inserts the current Page object into the database, and sets its ID property.
  */
 
  public function insert() {
 
    // Does the Page object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Page::insert(): Attempt to insert an Page object that already has its ID property set (to $this->id).", E_USER_ERROR );
 
    // Insert the Page
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );


    $sql = "INSERT INTO pages ( latestDate, title, summary, content ) VALUES ( FROM_UNIXTIME(:latestDate), :title, :summary, :content )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":latestDate", $this->latestDate, PDO::PARAM_INT );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }
 
 
  /**
  * Updates the current Page object in the database.
  */
 
  public function update() {
 
    // Does the Page object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Page::update(): Attempt to update an Page object that does not have its ID property set.", E_USER_ERROR );
    
    // Update the Page
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE pages SET latestDate=FROM_UNIXTIME(:latestDate), title=:title, summary=:summary, content=:content WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":latestDate", $this->latestDate, PDO::PARAM_INT );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
 
  /**
  * Deletes the current Page object from the database.
  */
 
  public function delete() {
 
    // Does the Page object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Page::delete(): Attempt to delete an Page object that does not have its ID property set.", E_USER_ERROR );
 
    // Delete the Page
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM pages WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
}


?>