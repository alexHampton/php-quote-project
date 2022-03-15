<?php

// Ensure id, quote, authorId, and categoryId are provided
if (!property_exists($data, 'id') || !property_exists($data, 'quote') || !property_exists($data, 'authorId') || !property_exists($data, 'categoryId')) {
    missingParams();
} else {
    // Instantiate Author and Category objects to check ids
    $auth = new Author($db);
    $cat = new Category($db);
    // Ensure quote's id is in db.
    if (!isValid($data->id, $quo)) {
        echo json_encode(
            array(
                "message" => "No Quotes Found"
            )
        );
    // Ensure authorId is in db.
    } else if (!isValid($data->authorId, $auth)) {
        notFound("author");
    // Ensure categoryId is in db.
    } else if (!isValid($data->categoryId, $cat)) {
        notFound("category");
    } else {
        // Update quote object
        $quo->theQuote = $data->quote;
        $quo->authorId = $data->authorId;
        $quo->categoryId = $data->categoryId;
        // Update quote in db
        if ($quo->update()) {
            echo json_encode(
                array(
                    'id' => $quo->id,
                    'quote' => $quo->theQuote,
                    'authorId' => $quo->authorId,
                    'categoryId' => $quo->categoryId
                )
            );
        } else {
            fail("Quote", "Updated");
        }

    }
}
exit();
?>