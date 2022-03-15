<?php

// Ensure category name is provided
if (!property_exists($data, 'id')) {
    missingParams();
} else {
    // Ensure id is found in db
    if (isValid($data->id, $cat)) {
        if ($cat->delete()) {
            echo json_encode(
                array(
                    'id' => $data->id
                )
            );
        } else {
            fail("Category", "Deleted");
        }
    } else {
        notFound("category");
    }
    
}
exit();
?>