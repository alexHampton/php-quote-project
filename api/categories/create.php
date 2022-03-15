<?php


// Ensure category name is provided
if (!property_exists($data, 'category')) {
    missingParams();
} else {
    $cat->name = $data->category;
    if ($cat->create()) {
        echo json_encode(
            array(
                'id' => $cat->id,
                'category' => $cat->name,
            )
        );
    } else {
        fail("Category", "Created");
    }
}


?>