<?php

// Echoes json message that parameters are missing
function missingParams() {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}

?>