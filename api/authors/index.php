<?php

// This file should be linked to all CRUD files

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';
include_once '../../helperFunctions/isValid.php';
include_once '../../helperFunctions/notFound.php';
include_once '../../helperFunctions/success.php';
include_once '../../helperFunctions/fail.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    // Used to indicate which HTTP methods are permitted while accessing the resources to the cross-origin requests:
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

// Instantiate DB Object and connect
$database = new Database();
$db = $database->connect();

// Instantiate author object
$theAuthor = new Author($db);

// Get data from user input
$data = file_get_contents('php://input');

// require the proper file based on user method ('GET, PUT, POST, DELETE)
switch ($method) {
    case 'GET': isset($_GET['id']) ? require 'read_single.php' : require 'read.php'; break;
    case 'PUT': require 'update.php'; break;
    case 'POST': require 'create.php'; break;
    case 'DELETE': require 'delete.php'; break;
}

?>