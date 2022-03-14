<?php

function notFound($modelType) {
    echo json_encode(
        array('message' => $modelType . 'Id Not Found')
    );
}

?>