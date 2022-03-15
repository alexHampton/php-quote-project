<?php

// make sure id and author are provided, 
// if not, return JSON 'Missing Required Parameters'
if (!property_exists($data, 'id') || !property_exists($data, 'author')) {
    missingParams();
} else {

    // Ensure id is found in db. 
    if (isValid($data->id, $theAuthor)) {
        // Update author
        $theAuthor->name = $data->author;

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
