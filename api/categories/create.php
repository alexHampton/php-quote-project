<?php


// Ensure category name is provided
if (!isset($_GET['category'])) {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
} else {
    $cat->name = $_GET['category'];
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