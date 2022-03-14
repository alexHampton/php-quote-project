<?php

// Category query
$result = $cat->read();

// Get row count
$rowCount = $result->rowCount();

// return json message if empty query
if ($rowCount == 0) {
    echo json_encode(
        array('message' => 'No categories found.')
    );
} else {
    $categories_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $category_item = array(
            'id' => $id,
            'category'=> $category
        );

        // Push to 'data'
        array_push($categories_arr, $category_item);

        
    }
    // Turn to JSON and output
    echo json_encode($categories_arr);
}

?>