<?php
header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, origin");

require_once __DIR__ . "/config.php";
include_once __DIR__ . "/classes.php";
include_once CORE_PACKAGE_ROOT . '/tools/JsonHandler.php';

use com\yp\tools\JsonHandler;

//print_r($_GET);

$handlerClass = "";
if (isset($_GET["handler"])) {
    $handlerClass = $_GET["handler"];
}
$function = "";
if (isset($_GET["function"])) {
    $function = $_GET["function"];
}
// 'OPTIONS', 'GET', 'POST'
$mothod = $_SERVER['REQUEST_METHOD'];
if ($handlerClass != "" && ($mothod == 'POST' || $mothod == 'GET')) {
    JsonHandler::initialize(CLASSES);   
    $handlerClass = JsonHandler::get_class($handlerClass);
    $handler = new $handlerClass();
    $params_json = file_get_contents("php://input");
    if (isset($_GET["params"])) {
        $params_json = $_GET["params"];
    }
   // error_log("params_json!" . $params_json);

    if ($mothod == 'POST' || $mothod == 'GET') {
        $params = array();

        if ($params_json != null) {
            $params = JsonHandler::parse($params_json);
        }

        $split = explode('@', $function);
        if (is_array($split) && count($split) > 1) {
            $function = $split[0];
            $queryName = $split[1];
        } else {
            $queryName = $function;
        }

        if ($params != null) {
            $data = $handler->$function($queryName, $params);
            if ($data != null) {
                $jsonStr = JsonHandler::stringify($data);
               // error_log("jsonStr!" . $jsonStr);
                echo $jsonStr;
            }
        }
    }
}

?>