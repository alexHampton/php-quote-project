<?php


// Ensure author name is provided
if (!property_exists($data, "author")) {
    missingParams();
} else {
    $theAuthor->name = $data->author;
    if ($theAuthor->create()) {
        echo json_encode(
            array(
                'id' => $theAuthor->id,
                'author' => $theAuthor->name
            )
        );
    } else {
        fail("Author", "Created");
    }
}

exit();

?>