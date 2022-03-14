<?php

function success($modelType, $op) {
    echo json_encode(
        array("message" => $modelType . " " . $op)
    );
}