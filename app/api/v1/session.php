<?php
include '../inc.control_top.php';

$data = json_decode(file_get_contents("php://input"));
if (!empty($data->username) && !empty($data->password)) {
  $session->validAccess($data->username, $data->password);
}
