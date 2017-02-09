<?php

class books {
    static public function put($book, $id) {
        //echo "Update a Book";
        return $id;
    }
}

$request = explode('/', $_GET['PATH_INFO']);
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
    case 'put':
        $body = file_get_contents('php://input');
        switch (strtolower($_SERVER['HTTP_CONTENT_TYPE'])) {
            case "application/json":
                $book = json_decode($body);
                break;
            case "text/xml":
                // parsing here
                break;
            default:
                //print_r($_SERVER['HTTP_CONTENT_TYPE']);
        }
        // Validate input

        // Modify the Resource
        $id = array_shift($request);
        $id = books::put($book, $request[0]); // Uses id from request
        http_response_code(204); // No conent
        break;
    default:
        http_response_code(405);
}