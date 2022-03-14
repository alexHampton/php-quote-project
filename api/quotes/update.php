<?php

$data = $_GET;
if (!isset($data['id']) || !isset($data['quote']) || !isset($data['authorId']) || !isset($data['categoryId'])) {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
} else {
    // Ensure id is found in db
    if (isValid($data['id'], $quo)) {
        // Update quote object
        $quo->theQuote = $data['quote'];
        $quo->authorId = $data['authorId'];
        $quo->categoryId = $data['categoryId'];

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
    } else {
        echo Json_encode(
            array('message' => 'categoryID Not Found')
        );
    }
}

?>