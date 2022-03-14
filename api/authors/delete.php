<?php

// Ensure author name is provided
if (!isset($_GET['id'])) {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
} else {
    // Ensure id is found in db
    if (isValid($_GET['id'], $theAuthor)) {
        if ($theAuthor->delete()) {
            echo json_encode(
                array(
                    'id' => $_GET['id']
                )
            );
        } else {
            fail("Author", "Deleted");
        }
    } else {
        notFound("author");
    }
    
}
