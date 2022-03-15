<?php

if (!property_exists($data, 'id') || !property_exists($data, 'quote') || !property_exists($data, 'authorId') || !property_exists($data, 'categoryId')) {
    missingParams();
} else {

    $auth = new Author($db);
    $cat = new Category($db);
    if (!isValid($data->id, $quo)) {
        echo json_encode(
            array(
                "message" => "No Quotes Found"
            )
        );
    } else if (!isValid($data->authorId, $auth)) {
        notFound("author");
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

?>