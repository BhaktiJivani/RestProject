<?php

class books {
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
    case 'delete':
        // Delete the Resource
        $id = array_shift($request);
        $id = books::delete($book, $request[0]); // Uses id from request
        http_response_code(204); // No conent
  
        break;
    default:
        http_response_code(405);
}