<?php


$data = $_GET;
// check to see if user provided some combination of 
// authorId and categoryId
if (isset($data['authorId'])) {
    $quo->authorId = $data['authorId'];

    // If both authorId and categoryId are provided:
    if (isset($data['categoryId'])) {
        $quo->categoryId = $data['categoryId'];
        $result = $quo->read_author_and_category();

    // If only authorId is provided:
    } else {
        $result = $quo->read_author();
    }

// If only categoryId is provided:
} else if (isset($data['categoryId'])) {
    $quo->categoryId = $data['categoryId'];
    $result = $quo->read_category();
// If nothing is provided, return all quotes:
} else {
    $result = $quo->read();
}



// Get row count
$rowCount = $result->rowCount();

// return json message if empty query
if ($rowCount == 0) {
    echo json_encode(
        array('message' => 'No Quotes Found.')
    );
} else {
    $quotes_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category

        );

        // Push to 'data'
        array_push($quotes_arr, $quote_item);
    }
    // Turn to JSON and output
    echo json_encode($quotes_arr);
}
