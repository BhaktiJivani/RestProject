<?php

class books {

    static public function post($book) {
        //echo "Create a Book";
        return 1234;
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
    case 'post':
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

        // Create new Resource
        //$id = call_user_func(array($resource, $method), $request);
        $id = books::post($book); // Returns id of 1234
        $json = json_encode(array('id' => $id));
        http_response_code(201); // Created
        $site = 'localhost';
        header("Location: $site/" . $_SERVER['REQUEST_URI'] . "/$id");
        header('Content-Type: application/json');
        print $json;
        break;
    default:
        http_response_code(405);
}