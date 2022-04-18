<?php

function route($method, $urlData, $formData) {       
    global $connect;

    if ($method == 'POST') {
        if (sizeof($urlData) == 1) {
            switch ($urlData[0]) {
                case 'register':
                    register($connect, $formData);
                    break;
                case 'login':
                    login($connect, $formData);
                    break;
                case 'logout':
                    logout($connect);
                    break;
                default: 
                    setStatus('404', 'Route does not exist');
            }
        }
        else {
            setStatus('404', 'Route does not exist');
        }
    }
    else {
        setStatus('400', 'Only POST methods available for auth');
    }
}

function register($connect, $formData) {
    $username = $formData->username;
    $name = $formData->name;
    $password = hash("sha1", $formData->password);

    if (!is_null(getIdOfUserByToken($connect, getToken()))) {
        setStatus('403', 'You can\'t register while you authorized in system');
        return;
    }
    if (is_null($username) || is_null($name) || is_null($password)) {
        setStatus('403', 'Register data can\'t be empty');
        return;
    }
    if (!validateStringInRange($username, 3, 21)) {
        setStatus('403', 'Not valid username');
        return;
    }
    if (!validateStringInRange($name, 3, 50)) {
        setStatus('403', 'Not valid name');
        return;
    }
    if (!validateStringInRange($formData->password, 8, 128)) {
        setStatus('403', 'Not valid password');
        return;
    }

    $userInsertResult = 
        $connect->query("INSERT INTO users (name, username, password)
        VALUES ('$name', '$username', '$password')");

    if ($userInsertResult) {
        $token = genToken();
        $userId = mysqli_insert_id($connect);
        $connect->query("INSERT INTO tokens (value, userId) VALUES ('$token', '$userId')");

        echo json_encode([
            'token' => $token
        ]);
    }
    else {
        setStatus('409', 'User with username '.$username.' already exist');
        return;
    }
}

function logout($connect) {
    if (is_null(getIdOfUserByToken($connect, getToken()))) {
        setStatus('401', 'You can\'t logout while you not authorized in system');
    }
    else {
        $token = getToken();
        $connect->query("DELETE FROM tokens WHERE value = '$token'");
        setStatus('200', 'OK. You logout');
    }
}

function login($connect, $formData) {
    if (!is_null(getIdOfUserByToken($connect, getToken()))) {
        setStatus('403', 'You can\'t login while you authorized in system');
        return;
    }

    $username = $formData->username;
    $password = hash("sha1", $formData->password);

    $userId = $connect->query("SELECT id FROM users WHERE username = '$username' AND password = '$password'")->fetch_assoc();
    $userId = $userId['id'];

    if ($userId) {
        $token = genToken();

        $connect->query("INSERT INTO tokens (value, userId) VALUES ('$token', '$userId')");
    
        echo json_encode([
            'token' => $token
        ]);
    }
    else {
        setStatus('403', 'Incorrect login or password');
    }
}