<?php

class Db {
  
  private $host      = DB_HOST;
  private $user      = DB_USER;
  private $pass      = DB_PASS;
  private $dbname    = DB_NAME;

  public $isConnected;

  private $dbh;
  private $error;
  private $stmt;

  public function __construct() {
    $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname.'';
    // Set options
    $options = array(
      PDO::ATTR_PERSISTENT    => true,
      PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION,
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
      );

    // Create a new PDO instanace
    try{
      $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
    }
    catch(PDOException $e) {
      $this->isConnected = false;
      $this->error = $e->getMessage();
    }
  }

  public function query($query) {
    $this->stmt = $this->dbh->prepare($query);
  }

  public function bind($param, $value, $type = null) {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
        $type = PDO::PARAM_INT;
        break;
        case is_bool($value):
        $type = PDO::PARAM_BOOL;
        break;
        case is_null($value):
        $type = PDO::PARAM_NULL;
        break;
        default:
        $type = PDO::PARAM_STR;
      }
    }
    $this->stmt->bindValue($param, $value, $type);
  }

  public function exec() {
    return $this->stmt->execute();
  }

  public function fetch() {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function single() {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function numrows() {
    return $this->stmt->rowCount();
  }

  public function lastId() {
    return $this->dbh->lastInsertId();
  }

  public function beginTrans() {
    return $this->dbh->beginTransaction();
  }

  public function endTrans() {
    return $this->dbh->commit();
  }

  public function cancelTrans() {
    return $this->dbh->rollBack();
  }

  public function debug() {
    return $this->stmt->debugDumpParams();
  }
}