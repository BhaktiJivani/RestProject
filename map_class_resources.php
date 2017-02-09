<?php

class books {
    static public function get($request) {
        echo "Get Books";
    }
    static public function post($request) {
        echo "Create a Book";
    }
}

class computers {
    static public function get($request) {
        echo "Get Computers";
    }
}

$request = explode('/', $_SERVER['PATH_INFO']);
array_shift($request);
$resource = array_shift($request);

// only process valid resources
$resources = array('books' => true, 'computers' => true);
if (!array_key_exists($resource, $resources)) {
    http_response_code(404);
    exit;
}
// route the request to the appropriate function based on method
$method = strtolower($_SERVER["REQUEST_METHOD"]);
switch ($method) {
    case 'get':
    case 'post':
    case 'put':
    case 'delete':
    // any other methods you want to support, such as HEAD
        if (method_exists($resource, $method)) {
            call_user_func(array($resource, $method), $request);
            break;
        }
    // fall through
    default:
        http_response_code(405);
}