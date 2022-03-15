<?php
// echoes json message saying the operation NOT completed
function fail(string $modelType, string $op) {
    echo json_encode(
        array('message' => $modelType . " NOT " . $op)
    );
}