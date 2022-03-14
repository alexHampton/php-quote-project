<?php

// make sure id and category are provided, 
// if not, return JSON 'Missing Required Parameters'
if (!isset($_GET['id']) || !isset($_GET['category'])) {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
} else {

    // Ensure id is found in db. 
    if (isValid($_GET['id'], $cat)) {
        // Update category
        $cat->name = $_GET['category'];

        // Update category in db
        if ($cat->update()) {
            echo json_encode(
                array(
                    'id' => $cat->id,
                    'category' => $cat->name,
                )
            );
        } else {
            fail("Category", "Updated");
        }
    } else {
        notFound("category");
    }    
}

?>