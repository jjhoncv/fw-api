<?php
require_once _model_ . "Rest.php";
require_once _facade_ . "UserSession.facade.php";

class UserSessionRest extends Rest
{
  private $_userSessionFacade;

  public function __construct()
  {
    parent::__constructor();
  }

  public function processPOST()
  {
    if ($this->method() === 'POST') {
      $data = $this->request();
      $this->_userSessionFacade = new UserSessionFacade($data->username, $data->password);
    }
  }

  public function responseJSON()
  {
    $data = $this->_userSessionFacade->data();

    $this->response(
      $this->json(
        array(
          "code" => $data->getCode(),
          "data" => array(
            "id" => $data->getUser()->getId(),
            "name" => $data->getUser()->getName(),
            "surname" => $data->getUser()->getSurname(),
            "mail" => $data->getUser()->getMail(),
            "photo" => $data->getUser()->getPhoto(),
            "login" => $data->getUser()->getLogin(),
            "password" => $data->getUser()->getPassword(),
            "token" => $data->getToken()
          ),
          "message" => $data->getMessage()
        )
      ),
      $data->getCode()
    );
  }
}
