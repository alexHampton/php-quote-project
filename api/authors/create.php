<?php

$data = file_get_contents('php://input');
echo $data;
// Ensure author name is provided
if (!isset($_GET['author'])) {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
} else {
    $theAuthor->name = $_GET['author'];
    if ($theAuthor->create()) {
        echo json_encode(
            array(
                'id' => $theAuthor->id,
                'author' => $theAuthor->name
            )
        );
    } else {
        fail("Author", "Created");
    }
}

?>