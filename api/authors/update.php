<?php

// make sure id and author are provided, 
// if not, return JSON 'Missing Required Parameters'
if (!isset($_GET['id']) || !isset($_GET['author'])) {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
} else {

    // Ensure id is found in db. 
    if (isValid($_GET['id'], $theAuthor)) {
        // Update author
        $theAuthor->name = $_GET['author'];

        // Update author
        if ($theAuthor->update()) {
            echo json_encode(
                array(
                    'id' => $theAuthor->id,
                    'author' => $theAuthor->name
                )
            );
        } else {
            fail("Author", "Updated");
        }
    } else {
        notFound("author");
    }    
}
