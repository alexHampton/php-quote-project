<?php


// isValid sets the object to the id then reads
// that value from the db. 
// Returns true if id was found.

if (isValid($_GET['id'], $cat)) {
    $cat_arr = array(
        'id' => $cat->id,
        'category' => $cat->name
    );
    // Make JSON
    echo json_encode($cat_arr);
} else {
    notFound("category");
}



?>
