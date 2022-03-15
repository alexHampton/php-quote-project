<?php

// Ensure author name is provided
if (!property_exists($data, "id")) {
    missingParams();
} else {
    // Ensure id is found in db
    if (isValid($data->id, $theAuthor)) {
        if ($theAuthor->delete()) {
            echo json_encode(
                array(
                    'id' => $data->id
                )
            );
        } else {
            fail("Author", "Deleted");
        }
    } else {
        notFound("author");
    }
    
}
