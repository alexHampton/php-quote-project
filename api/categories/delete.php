<?php

// Ensure category name is provided
if (!isset($_GET['id'])) {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
} else {
    // Ensure id is found in db
    if (isValid($_GET['id'], $cat)) {
        if ($cat->delete()) {
            success("Category", "Deleted");
        } else {
            fail("Category", "Deleted");
        }
    } else {
        notFound("category");
    }
    
}

?>