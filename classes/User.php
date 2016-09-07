<?php

 
/**
 * Class to handle users
 */

class User
{
 
  // Properties
 
  /**
  * @var int The user ID from the database
  */
  public $id = null;
 
  /**
  * @var string Full title of the user
  */
  public $username = null;
 
  /**
  * @var string A short summary of the user
  */
  public $password = null;
 
  /**
  * @var string The HTML content of the user
  */
  public $active = null;
 
public $page = null;
public $gallery = null;
public $news = null;
public $comments = null;
public $themes = null;
 
  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
 
  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['username'] ) ) $this->username = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['username'] );
    if ( isset( $data['password'] ) ) $this->password = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['password'] );
    if ( isset( $data['active'] ) ) $this->active = (int) $data['active'];
    if ( isset( $data['page'] ) ) $this->page = (int) $data['page'];
    if ( isset( $data['gallery'] ) ) $this->gallery = (int) $data['gallery'];
    if ( isset( $data['news'] ) ) $this->news = (int) $data['news'];
    if ( isset( $data['comments'] ) ) $this->comments = (int) $data['comments'];
    if ( isset( $data['themes'] ) ) $this->themes = (int) $data['themes'];
  }
 
 
  /**
  * Returns an User object matching the given user ID
  *
  * @param int The user ID
  * @return User|false The user object, or false if the record was not found or there was a problem
  */
 
  public static function getById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM users WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new User( $row );
  }
 
 
  /**
  * Returns all (or a range of) User objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the users (default="latestDate DESC")
  * @return Array|false A two-element array : results => array, a list of User objects; totalRows => Total number of users
  */
 
  public static function getList( $numRows=1000000, $order="id ASC" ) {
    $link = mysqli_connect("sql6.freemysqlhosting.net", "sql6134728", "xGTEF6YqgD", "sql6134728");
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM users
            ORDER BY " . mysqli_real_escape_string ($link ,$order ) . " LIMIT :numRows";
 
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();
 
    while ( $row = $st->fetch() ) {
      $user = new User( $row );
      $list[] = $user;
    }
 
    // Now get the total number of users that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }
 
 
  /**
  * Inserts the current User object into the database, and sets its ID property.
  */
 
  public function insert() {
 
    // Does the User object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "User::insert(): Attempt to insert an User object that already has its ID property set (to $this->id).", E_USER_ERROR );
 
    // Insert the User
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );


    $sql = "INSERT INTO users ( username, password, active ) VALUES ( :username, :password, :active )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":username", $this->username, PDO::PARAM_STR );
    $st->bindValue( ":password", $this->password, PDO::PARAM_STR );
    $st->bindValue( ":active", $this->active, PDO::PARAM_INT );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }
 
 
  /**
  * Updates the current User object in the database.
  */
 
  public function update() {
 
    // Does the User object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "User::update(): Attempt to update an User object that does not have its ID property set.", E_USER_ERROR );
    
    // Update the User
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE users SET  username=:username, password=:password, active=:active WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":username", $this->username, PDO::PARAM_STR );
    $st->bindValue( ":password", $this->password, PDO::PARAM_STR );
    $st->bindValue( ":active", $this->active, PDO::PARAM_INT );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
 
  /**
  * Deletes the current User object from the database.
  */
 
  public function delete() {
 
    // Does the User object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "User::delete(): Attempt to delete an User object that does not have its ID property set.", E_USER_ERROR );
 
    // Delete the User
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM users WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
}


?>