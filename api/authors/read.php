<?php

// Author query
$result = $theAuthor->read();

// Get row count
$rowCount = $result->rowCount();

// return json message if empty query
if ($rowCount == 0) {
    echo json_encode(
        array('message' => 'No authors found.')
    );
} else {
    $authors_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $author_item = array(
            'id' => $id,
            'author'=> $author
        );

        // Push to 'data'
        array_push($authors_arr, $author_item);

        
    }
    // Turn to JSON and output
    echo json_encode($authors_arr);
}
