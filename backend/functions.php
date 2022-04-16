<?php

function getFormData($method) {    
    if ($method === 'GET') return $_GET;
    if ($method === 'POST' && !empty($_POST)) return $_POST;

    $incomingData = file_get_contents('php://input');
    $decodedJSON = json_decode($incomingData);

    if ($decodedJSON) 
    {
        $data = $decodedJSON;
    } 
    else  {
        $data = array();
        $exploded = explode('&', file_get_contents('php://input'));     
        foreach ($exploded as $pair) 
        {
            $item = explode('=', $pair);
            if (count($item) == 2) 
            {
                $data[urldecode($item[0])] = urldecode($item[1]);
            }
        } 
    }

    return $data;
}

function genToken() {
	$token = random_bytes(16);
	return bin2hex($token); 
}

function getToken() {
    $token = getallheaders()['Authorization'];
    $token = substr($token, 7);
    return $token;
}

function getIdOfUserByToken($connect, $token) {
    $userId = $connect->query("SELECT userId FROM tokens WHERE value = '$token'")->fetch_assoc();
    return $userId['userId'];
}

function checkForAdmin($connect, $token) {
    $userId = getIdOfUserByToken($connect, $token);

    if ($userId) {
        $checkForAdmin = $connect->query("SELECT roleId FROM users WHERE userId = $userId")->fetch_assoc();   
        if ($checkForAdmin['roleId']) {
            return true;
        }
    }

    return false;
}