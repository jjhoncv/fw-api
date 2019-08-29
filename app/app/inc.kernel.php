<?php
include "config.php";
define("_ruta_", $_config["server"]["host"]);
define("_model_", _ruta_ . "app/models/");
define("_dao_", _ruta_ . "app/dao/");
define("_service_", _ruta_ . "app/services/");
define("_facade_", _ruta_ . "app/facade/");
define("_utils_", _ruta_ . "app/utils/");
