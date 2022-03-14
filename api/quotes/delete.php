<?php

// Ensure id is provided
if (!isset($_GET['id'])) {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
} else {
    // Ensure id is found in db
    if (isvalid($_GET['id'], $quo)) {
        if ($quo->delete()) {
            success("Quote", "Deleted");
        } else {
            fail("Quote", "Deleted");
        }
    } else {
        echo json_encode(
            array('message' => 'No Quotes Found')
        );
    }
}

?>