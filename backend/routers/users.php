<?php 

function route($method, $urlData, $formData) {    
    global $connect;

    $yourId = getIdOfUserByToken($connect, getToken());

    if (!is_null($yourId)) {
        switch ($method) {
            case 'GET':
                if (!sizeof($urlData)) getUsers($connect, $yourId);
                else if (sizeof($urlData) == 1) getUser($connect, $urlData[0]);
                else setStatus('404', 'Route does not exist');
                break;
            case 'PATCH':
                if (sizeof($urlData) == 1 && $yourId == $urlData[0]) editUser($connect, $formData, $urlData[0]);
                else setStatus('403', 'You do not have enough rights to update this user');
                break;
            case 'POST':
                if (sizeof($urlData) == 2 && $urlData[1] == 'avatar' && $yourId == $urlData[0]) loadAvatar($connect, $urlData[0], $_FILES['avatar']);
                else setStatus('403', 'You do not have enough rights to update this user');
                break;
            case 'DELETE':
                if (sizeof($urlData) == 1 && $yourId == $urlData[0]) deleteUser($connect, $urlData[0]);
                else setStatus('403', 'You do not have enough rights to delete this user');
                break;
            default:
                setStatus('400', 'Only GET, PATCH, DELETE, POST methods available for users');
        }
    }
    else {
        setStatus('401', 'You\'re not authorized in system');
    }

    return;
}

function getUsers($connect, $yourId) {
    $users = $connect->query("SELECT * FROM users");
    $usersList = [];

    $following = $connect->query("SELECT followedId FROM `following` WHERE userId = $yourId");
    
    $followingList = [];

    while ($f = $following->fetch_assoc()) {
        array_push($followingList, $f['followedId']);
    }
    
    while ($user = $users->fetch_assoc()) {
        $followed = in_array($user['id'], $followingList);

        $usersList[] = [
            "userId" => (int)$user['id'],
            "username" => $user['username'],
            "avatar" => $user['avatar'],
            "followed" => $followed
        ];
    }
    
    echo json_encode($usersList);
}

function getUser($connect, $userId) {
    $user = $connect->query("SELECT * FROM users WHERE id = '$userId'")->fetch_assoc();

    $followers = $connect->query("SELECT userId FROM `following` WHERE followedId = $userId");
    
    $followersList = [];

    while ($f = $followers->fetch_assoc()) {
        array_push($followersList, $f['userId']);
    }

    if (!is_null($user)) {
        $userData[] = [
            "userId" => (int)$user['id'],
            "username" => $user['username'],
            "name" => $user['name'],
            "avatar" => $user['avatar'],
            "status" => $user['status'],
            "followers" => sizeof($followersList)
        ];

        echo json_encode($userData);
    }
    else {
        setStatus('404', 'User with id = '.$userId.' does not exist');
    }
}

function editUser($connect, $formData, $userId) {
    $user = $connect->query("SELECT id FROM users WHERE id = $userId")->fetch_assoc();

    if (!is_null($user)) {
        $username = $formData->username;
        $name = $formData->name;
        $password =  hash("sha1", $formData->password);
        $status = $formData->status;

        if (!is_null($name) && validateStringInRange($name, 3, 50)) {
            $connect->query("UPDATE users SET name = '$name' WHERE id = $userId");
        }
        else if (!is_null($name)) {
            setStatus('403', 'Not valid name');
            return;
        }

        if (!is_null($formData->password) && validateStringInRange($formData->password, 8, 128)) {
            $connect->query("UPDATE users SET password = '$password' WHERE id = $userId");
        }
        else if (!is_null($formData->password)) {
            setStatus('403', 'Not valid password');
            return;
        }

        if (!is_null($status) && validateStringInRange($status, 1, 50)) {
            $connect->query("UPDATE users SET status = '$status' WHERE id = $userId");
        }
        else if (!is_null($status)) {
            setStatus('403', 'Not valid status');
            return;
        }

        if (!is_null($username) && validateStringInRange($username, 3, 21)) {
            $userUpdateResult = $connect->query("UPDATE users SET username = '$username' WHERE id = $userId");
            if (!$userUpdateResult) {
                setStatus('409', 'User with username '.$username.' already exist');
                return;
            }
        }
        else if (!is_null($username)) {
            setStatus('403', 'Not valid username');
            return;
        }

        setStatus("200", "OK. User updated");
    }
    else {
        setStatus('404', 'User with id = '.$userId.' does not exist');
    }
}

function loadAvatar($connect, $userId, $file) {
    $user = $connect->query("SELECT id FROM users WHERE id = $userId")->fetch_assoc();

    if (!is_null($user)) {
        $path = './avatars/avatar-' . $userId . '.jpg';
        $connect->query("UPDATE users SET avatar = '$path' WHERE id = $userId");
        
        move_uploaded_file($file['tmp_name'], $path);
        setStatus("200", "OK. Avatar loaded");
    }
    else {
        setStatus('404', 'User with id = '.$userId.' does not exist');
    }
}

function deleteUser($connect, $userId) {
    $user = $connect->query("SELECT id FROM users WHERE id = $userId")->fetch_assoc();

    if (!is_null($user)) {
        $connect->query("DELETE FROM users WHERE id = $userId");
        setStatus("200", "OK. User deleted");
    }
    else {
        setStatus('404', 'User with id = '.$userId.' does not exist');
    }
}