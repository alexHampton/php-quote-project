<?php

echo $data;
echo $data['author'];
// Ensure author name is provided
if ($data['author'] == null) {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
} else {
    $theAuthor->name = $data['author'];
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

?>