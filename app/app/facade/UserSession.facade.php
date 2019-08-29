<?php
require_once _service_ . "UserSession.service.php";
require_once _model_ . "Rest.php";

class UserSessionFacade extends Rest
{
  private $_userSessionService;

  public function __construct($username, $password)
  {
    parent::__constructor();
    $this->_userSessionService = new UserSessionService($username, $password);
    $this->_userSessionService->loggin();
  }

  public function responseJSON()
  {
    $user = $this->_userSessionService->getUser();
    $token = $this->_userSessionService->getToken();
    $code = $this->_userSessionService->getCode();
    $message = $this->_userSessionService->getMessage();

    $this->response(
      $this->json(
        array(
          "code" => $code,
          "data" => array(
            "id" => $user->getId(),
            "name" => $user->getName(),
            "surname" => $user->getSurname(),
            "mail" => $user->getMail(),
            "photo" => $user->getPhoto(),
            "login" => $user->getLogin(),
            "password" => $user->getPassword(),
            "token" => $token->getToken()
          ),
          "message" => $message
        )
      ),
      $code
    );
  }
}
