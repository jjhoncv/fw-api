<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once "./../../app/inc.kernel.php";
require_once _model_ . "Db.php";
require_once _model_ . "User.php";
require_once _model_ . "Session.php";
require_once _model_ . "Token.php";

session_start();
$session = new Session();
$token = new Token();

$data = json_decode(file_get_contents("php://input"));
if (!empty($data->username) && !empty($data->password)) {
    $session->validAccess($data->username, $data->password);
} else {
    $token->validToken();
}

if (!is_object($session->getUser()->getRole()) &&
    $session->getUser()->getLoggedIn() === false) {
    // $code = 400;
    // http_response_code($code);
    // echo json_encode(array(
    //     "error" => array(
    //         "status" => $code,
    //         "description" => "Unauthorized",
    //     ),
    // ));
}
// if ($session->getUser()->getLoggedIn() === false) {header("location:/admin");}
