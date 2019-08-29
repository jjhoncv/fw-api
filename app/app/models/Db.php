<?php
include_once _model_ . "../config.php";
class Db
{
  private $_mysqli,
    $_query,
    $_results = array(),
    $_result = array(),
    $_record = array(),
    $_host = DBHOST,
    $_user = DBUSER,
    $_pass = DBPASS,
    $_bd = DBNAME;

  public static $instance;

  public static function getInstance()
  {
    if (!isset(self::$instance)) {
      self::$instance = new Db();
    }
    return self::$instance;
  }

  public function __construct()
  {
    $this->_mysqli = new mysqli(
      $this->_host,
      $this->_user,
      $this->_pass,
      $this->_bd
    );
    $this->_mysqli->set_charset("utf8");

    if ($this->_mysqli->connect_error) {
      die($this->_mysqli->connect_error);
    }
  }
  public function query($sql)
  {
    if ($this->_query = $this->_mysqli->query($sql)) {
      return $this;
    }
  }

  public function result()
  {
    $this->_results = $this->_query->fetch_array(MYSQLI_ASSOC);
    return $this->_results;
  }

  public function results()
  {
    $this->_results = array();
    while ($row = $this->_query->fetch_array(MYSQLI_ASSOC)) {
      $this->_results[] = $row;
    }
    return $this->_results;
  }

  public function count()
  {
    return $this->_query->num_rows;
  }

  public function fieldsCount()
  {
    return $this->_query->field_count;
  }

  public function insertId()
  {
    return $this->_mysqli->insert_id;
  }

  public function nameTable()
  {
    return $this->_query->fetch_field_direct(1)->table;
  }

  public function nameField($indexField)
  {
    $columns = $this->_query->fetch_fields();
    return $columns[$indexField]->name;
  }

  public function typeField($indexField)
  {
    $columns = $this->_query->fetch_fields();
    return $columns[$indexField]->type;
  }

  public function lengthField($indexField)
  {
    $columns = $this->_query->fetch_fields();
    return $columns[$indexField]->length;
  }
}
