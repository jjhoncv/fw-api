<?php
require_once _dao_ . "UserSession.dao.php";
require_once _model_ . "Token.php";

class UserSessionService
{
  private $_token;
  private $_userSessionDao;
  private $_user;

  public function __construct($username, $password)
  {
    $this->_token = new Token();
    $this->_userSessionDao = new UserSessionDao($username, $password);
    $this->_userSessionDao->validCredentials();
  }

  public function loggin()
  {
    $id = $this->_userSessionDao->getId();
    $this->_user = new User($id);
    $this->addUserToSession();
    $this->_user->setLoggedIn(true);
    $this->_token->createToken(
      array('id' => $this->_id)
    );
  }

  public function addUserToSession()
  {
    $_SESSION['user'] = $this->_user;
  }

  public function getUser()
  {
    return $this->_user;
  }

  public function getMessage()
  {
    return $this->_userSessionDao->getMessage();
  }

  public function getCode()
  {
    return $this->_userSessionDao->getCode();
  }

  public function getToken()
  {
    return $this->_token->getToken();
  }
}
