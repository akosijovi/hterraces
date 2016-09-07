<?php
 
/**
 * Class to handle comments
 */

class Comment
{
 
  // Properties
 
  /**
  * @var int The comment ID from the database
  */
  public $id = null;
 
  /**
  * @var int When the comment was published
  */
  public $publicationDate = null;
 
  /**
  * @var string Full title of the comment
  */
  public $title = null;
 
  /**
  * @var string A short summary of the comment
  */
  public $summary = null;
 
  /**
  * @var string The HTML content of the comment
  */
  public $content = null;
 
  /**
  * @var string The name of the user
  */
  public $name = null;

  /**
  * @var string For validating the email
  */
  public $hash= null;

  /**
  * @var string If the email is verified
  */
  public $active= null;
 
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
    if ( isset( $data['name'] ) ) $this->name = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['name'] );
    if ( isset( $data['hash'] ) ) $this->hash= preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['hash'] );
    if ( isset( $data['active'] ) ) $this->active= (int) $data['active'];
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
    if ( isset($params['publicationDate']) ) {
      $publicationDate = explode ( '-', $params['publicationDate'] );
 
      if ( count($publicationDate) == 3 ) {
        list ( $y, $m, $d ) = $publicationDate;
        $this->publicationDate = mktime ( 0, 0, 0, $m, $d, $y );
      }
    }
  }
 
 
  /**
  * Returns an Comment object matching the given comment ID
  *
  * @param int The comment ID
  * @return Comment|false The comment object, or false if the record was not found or there was a problem
  */
 
  public static function getById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM comments WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Comment( $row );
  }
 
 
  /**
  * Returns all (or a range of) Comment objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the comments (default="publicationDate DESC")
  * @return Array|false A two-element array : results => array, a list of Comment objects; totalRows => Total number of comments
  */
 
  public static function getList( $numRows=1000000, $order="id DESC" ) {
    $link = mysqli_connect("sql6.freemysqlhosting.net", "sql6134728", "xGTEF6YqgD", "sql6134728");
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM comments
            ORDER BY " . mysqli_real_escape_string ($link ,$order ) . " LIMIT :numRows";
 
 
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();
 
    while ( $row = $st->fetch() ) {
      $comment = new Comment( $row );
      $list[] = $comment;
    }
 
    // Now get the total number of comments that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }
 
 
  /**
  * Inserts the current Comment object into the database, and sets its ID property.
  */
 
  public function insert() {
 
    // Does the Comment object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Comment::insert(): Attempt to insert an Comment object that already has its ID property set (to $this->id).", E_USER_ERROR );
 
    // Insert the Comment
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO comments ( publicationDate, title, summary, content, name, hash, active ) VALUES ( FROM_UNIXTIME(:publicationDate), :title, :summary, :content, :name, :hash, :active )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":name", $this->name, PDO::PARAM_STR );
    $st->bindValue( ":hash", $this->hash, PDO::PARAM_STR );
    $st->bindValue( ":active", $this->active, PDO::PARAM_INT );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;


  }
 
 
  /**
  * Updates the current Comment object in the database.
  */
 
  public function update() {
 
    // Does the Comment object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Comment::update(): Attempt to update an Comment object that does not have its ID property set.", E_USER_ERROR );
    
    // Update the Comment
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE comments SET publicationDate=FROM_UNIXTIME(:publicationDate), title=:title, summary=:summary, content=:content, name=:name, hash=:hash, active=:active, WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":name", $this->name, PDO::PARAM_STR );
    $st->bindValue( ":hash", $this->hash, PDO::PARAM_STR );
    $st->bindValue( ":active", $this->active, PDO::PARAM_INT );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
 
  /**
  * Deletes the current Comment object from the database.
  */
 
  public function delete() {
 
    // Does the Comment object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Comment::delete(): Attempt to delete an Comment object that does not have its ID property set.", E_USER_ERROR );
 
    // Delete the Comment
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM comments WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

}
 

?>