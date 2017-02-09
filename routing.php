<?php

$request = explode('/', $_SERVER['PATH_INFO']);
$method = strtolower($_SERVER['REQUEST_METHOD']);
switch ($method) {
    case 'get':
        // handle a GET request break;
        print_r($_SERVER['PATH_INFO']);
        print_r($request);
    case 'post':
    // handle a POST request break;
    case 'put':
    // handle a PUT request break;
    case 'delete':
    // handle a DELETE request break;
    default:
    // unimplemented method http_response_code(405);
}