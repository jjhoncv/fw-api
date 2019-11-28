<?php
require_once _service_ . "UserSession.service.php";

class UserSessionFacade
{
  private $_userSessionService;
  private $_data;

  public function __construct($username, $password)
  {
    // parent::__constructor();
    $this->_userSessionService = new UserSessionService($username, $password);
    $this->_userSessionService->loggin();
    // $this->data();

  }

  public function data()
  {

    // $data = new stdClass();
    // $data->user = $this->_userSessionService->getUser();
    // $data->token = $this->_userSessionService->getToken();
    // $data->code = $this->_userSessionService->getCode();
    // $data->message = $this->_userSessionService->getMessage();

    return $this->_userSessionService;
    // return $data;
    // $this->_data = array(
    //   "user" => $this->_userSessionService->getUser(),
    //   "token" => $this->_userSessionService->getToken(),
    //   "code" => $this->_userSessionService->getCode(),
    //   "message" => $this->_userSessionService->getMessage()
    // );

    // $user = $this->_userSessionService->getUser();
    // $token = $this->_userSessionService->getToken();
    // $code = $this->_userSessionService->getCode();
    // $message = $this->_userSessionService->getMessage();


  }
}
