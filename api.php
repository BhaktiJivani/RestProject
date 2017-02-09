<?php

class books {
    static public function get($id) {
        $book = [
            'id' => 1234,
            'title' => 'PHP Programming',
            'price' => 58.8,
            'publisher' => [
                            'publisher' => 'Apress',
                            'address' => 'Fremont'
                        ],
        ];
        return $book;
    }
    static public function post($request) {
        //echo "Create a Book";
        return 1234;
    }
    static public function put($book, $id) {
        //echo "Update a Book";
        return $id;
    }
     static public function delete($book, $id) {
        //echo "Delete a Book";
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
    case 'get':
        // Get the Resource
        $id = array_shift($request);
        $book = books::get($id ); // Returns id of 1234
        $json = json_encode($book);
        http_response_code(200); // OK
        header('Content-Type: application/json');
        print $json;
        break;
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
                $book = $body;
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
    case 'delete':
        // Delete the Resource
        $id = array_shift($request);
        $id = books::delete($book, $request[0]); // Uses id from request
        http_response_code(204); // No conent
  
        break;
    default:
        http_response_code(405);
}