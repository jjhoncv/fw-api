<?php
include '../inc.control_top.php';
require_once _model_ . "User.php";
require_once _model_ . "Users.php";
require_once _utils_ . "headers.php";
require_once _model_ . "Sections.php";

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case 'GET':
        $get = (object) $_GET;
        if (isset($get->_id)) {
            $id = intval($_GET["id"]);
            $section = new Section($id);
        } else {
            $modules = explode(",", $session->getUser()->getModules());
            sort($modules);
            if (is_array($modules)) {
                $sections = new Sections();
                foreach ($modules as $key => $value) {
                    $module = new Module($value);
                    $list[] = array(
                        'id' => $value,
                        'name' => $module->getName(),
                        'sections' => $sections->getSectionsByModule($value),
                    );
                }
            }
        }

        $data = array(
            "data" => $list,
        );

        http_response_code($code);
        echo json_encode($data);

        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
