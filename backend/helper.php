<?php

function setStatus($status = '200', $message = null) {
    switch($status) {
        default:
        case '200':
            $status = 'HTTP/1.0 200 OK';
            break;
        case '400':
            $status = 'HTTP/1.0 400 Bad Request';
            break;
        case '401':
            $status = 'HTTP/1.0 401 Unauthtorized';
            break;
        case '403':
            $status = 'HTTP/1.0 403 Forbidden';
            break;
        case '404':
            $status = 'HTTP/1.0 404 Not Found';
            break;
        case '409':
            $status = "HTTP/1.0 409 conflict";
            break;
        case '500':
            $status = 'HTTP/1.0 500 Internal server Error';
            break;  
    }
    header($status);
    if (!is_null($message)) {
        echo json_encode([
            "message" => "$message"
        ]);
    }
}

function validateStringInRange($str = '', $start = 0, $end = 512) {
    if (strlen($str) >= $start && strlen($str) <= $end) return true;
    return false;
}