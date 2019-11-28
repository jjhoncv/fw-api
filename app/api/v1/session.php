<?php
include '../inc.control_top.php';
require_once _rest_ . "UserSession.rest.php";

$userSessionRest = new UserSessionRest();
$userSessionRest->processPOST();
$userSessionRest->responseJSON();
// $userSessionFacade = new UserSessionFacade($username, $password);
// $userSessionFacade->responseJSON();

// $data = json_decode(file_get_contents("php://input"));
// if (!empty($data->username) && !empty($data->password)) {
//   $session->validAccess($data->username, $data->password);
// }
