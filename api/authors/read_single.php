<?php


// isValid sets the object to the id then reads
// that value from the db. 
// Returns true if id was found.

if (isValid($_GET['id'], $theAuthor)) {
    $author_arr = array(
        'id' => $theAuthor->id,
        'author' => $theAuthor->name
    );
    // Make JSON
    echo json_encode($author_arr);
} else {
    notFound("author");
}

?>