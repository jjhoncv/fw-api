<?php
header("Access-Control-Allow-Origin: *");
// header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: *');
header("Access-Control-Allow-Headers: X-Requested-With");
// header('Content-Type: text/html; charset=utf-8');
// header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
header("Content-Type:application/json");


// GET
// if (isset($_GET) && isset($_GET['session'])) {
//     $data = array('name' => 'xxx');
//     echo json_encode($data);
// }

// POST
// if (isset($_POST['user']) && isset($_POST['password'])) {
//     echo "ss";
//     die();
// echo "<pre>";
// print_r($_SERVER);
// echo $_POST['user']
$_POST = file_get_contents("php://input");
print_r($_POST);
// print_r($_POST);
echo "user : " . ($_POST['user']);
// $user = print_r($_REQUEST);
// $password = $_POST['password'];
// echo "aa : " . $user;
// die();
if ($user === "root" && $password === "admin") {
  echo json_encode(array('logged' => true));
}
// }
