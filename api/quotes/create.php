<?php
$userData = $_GET;
// Ensure quote, authorId, and category Id are provided
if (!isset($userData['quote']) || !isset($userData['authorId']) || !isset($userData['categoryId'])) {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
} else {
    $auth = new Author($db);
    $cat = new Category($db);
    if (!isValid($userData['authorId'], $auth)) {
        notFound("author");
    } else if (!isValid($userData['categoryId'], $cat)) {
        notFound("category");
    } else {
        $quo->theQuote = $userData['quote'];
        $quo->authorId = $userData['authorId'];
        $quo->categoryId = $userData['categoryId'];

        if ($quo->create()) {
            echo json_encode(
                array(
                    'id' => $quo->id,
                    'quote' => $quo->theQuote,
                    'authorId' => $quo->authorId,
                    'categoryId' => $quo->categoryId
                )
            );
        } else {
            fail("Quote", "Created");
        }
    }
}
