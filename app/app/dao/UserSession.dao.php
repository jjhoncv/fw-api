<?php
require_once _model_ . "User.php";
require_once _model_ . "Token.php";

class UserSessionDao
{
  private $_id = null, $_username, $_password, $_users, $_message = '', $_code = 200;

  public function __construct($username, $password)
  {
    $this->_username = $username;
    $this->_password = $password;
  }

  public function searchUserByCredentials()
  {
    $this->_users = Db::getInstance()->query("SELECT id_user FROM users WHERE login_user='" . $this->_username . "' AND password_user='" . $this->_password . "'");
    if ($this->_users->count() <= 0) {
      $this->_code = 401;
      throw new Exception('User not Found');
    }
  }

  public function validCredentials()
  {
    try {
      $this->searchUserByCredentials();
      $row = $this->_users->result();
      $this->_id = $row['id_user'];
      $this->_code = 200;
    } catch (Exception $e) {
      $this->_message = $e->getMessage();
    }
  }

  public function getMessage()
  {
    return $this->_message;
  }

  public function getId()
  {
    return $this->_id;
  }

  public function getCode()
  {
    return $this->_code;
  }
}
