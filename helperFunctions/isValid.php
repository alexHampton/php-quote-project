<?php

// Used to ensure user-provided id is found in the database
// Used for Category, Author, and Quote models.

// Sets the model to the value of the id provided and then reads
// that id from the db. 
// Returns true if id is found, false if not.
function isValid($id, $model){ 
    $model->id = $id;
    $model->read_single();
    $className = get_class($model);
    if ($className === "Category" || $className == "Author") {
        return $model->name;
    } else if ($className === "Quote") {
        return ($model->theQuote);
    }
}

?>