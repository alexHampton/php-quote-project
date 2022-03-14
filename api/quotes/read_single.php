<?php


// isValid sets the object to the id then reads
// that value from the db. 
// Returns true if id was found.

if (isValid($_GET['id'], $quo)) {
    $quote_arr = array(
        'id' => $quo->id,
        'quote' => $quo->theQuote,
        'author' => $quo->theAuthor,
        'category' => $quo->theCategory
    );
    // Make JSON
    echo json_encode($quote_arr);
} else {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}
