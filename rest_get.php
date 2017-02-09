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
    default:
        http_response_code(405);
}