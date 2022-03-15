<?php


// make sure id and category are provided, 
// if not, return JSON 'Missing Required Parameters'
if (!property_exists($data, 'id') || !property_exists($data, 'category')) {
    missingParams();
} else {

    // Ensure id is found in db. 
    if (isValid($data->id, $cat)) {
        // Update category
        $cat->name = $data->category;

        // Update category in db
        if ($cat->update()) {
            echo json_encode(
                array(
                    'id' => $cat->id,
                    'category' => $cat->name,
                )
            );
        } else {
            fail("Category", "Updated");
        }
    } else {
        notFound("category");
    }    
}
exit();
?>