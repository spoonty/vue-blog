<?php 

function route($method, $urlData, $formData) {    
    global $connect;

    $yourId = getIdOfUserByToken($connect, getToken());

    if (!is_null($yourId)) {
        switch ($method) {
            case 'GET':
                if (sizeof($urlData) == 1) getPosts($connect, $urlData[0]);
                else setStatus('404', 'Route does not exist');
                break;
            case 'POST':
                if (sizeof($urlData) == 1 && $yourId == $urlData[0]) addPost($connect, $formData, $urlData[0]);
                else if (sizeof($urlData) == 2 && $urlData[1] == 'like') likePost($connect, $urlData[0], $yourId);
                else setStatus('403', 'You do not have enough rights to add post for this user');
                break;
            case 'DELETE':
                if (sizeof($urlData) == 1) deletePost($connect, $urlData[0], $yourId);
                else if (sizeof($urlData) == 2 && $urlData[1] == 'like') unlikePost($connect, $urlData[0], $yourId);
                else setStatus('404', 'Route does not exist');
                break;
            default:
                setStatus('400', 'Only GET, DELETE, POST methods available for posts');
        }
    }
    else {
        setStatus('401', 'You\'re not authorized in system');
    }

    return;
}

function getPosts($connect, $userId) {
    $user = $connect->query("SELECT id FROM users WHERE id = $userId")->fetch_assoc();

    if (!is_null($user)) {
        $posts = $connect->query("SELECT * FROM posts WHERE userId = $userId");
        $postsList = [];
        
        while ($post = $posts->fetch_assoc()) {
            $postId = (int)$post['id'];
            $likes = $connect->query("SELECT userId FROM likedposts WHERE postId = $postId");
            $likesList = [];
    
            while ($p = $likes->fetch_assoc()) {
                array_push($likesList, $p['userId']);
            }
    
            $postsList[] = [
                "postId" => $postId,
                "text" => $post['text'],
                "date" => $post['date'],
                "likes" => sizeof($likesList)
            ];
        }
        
        echo json_encode($postsList);
    }
    else {
        setStatus('404', 'User with id = '.$userId.' does not exist');
    }
}

function addPost($connect, $formData, $userId) {
    $user = $connect->query("SELECT id FROM users WHERE id = $userId")->fetch_assoc();

    if (!is_null($user)) {
        $date = date("d-m-Y");
        $text = $formData->text;
    
        if (!is_null($text) && validateStringInRange($text, 1)) {
            $connect->query("INSERT INTO posts (userId, text, date) VALUES ($userId, '$text', '$date')");
            setStatus('200', 'OK. Post added');
        }   
        else {
            setStatus('403', 'Not valid post text');
            return;
        }
    }
    else {
        setStatus('404', 'User with id = '.$userId.' does not exist');
    }
}

function likePost($connect, $postId, $userId) {
    $user = $connect->query("SELECT id FROM users WHERE id = $userId")->fetch_assoc();

    if (!is_null($user)) {
        $post = $connect->query("SELECT id FROM posts WHERE id = $postId")->fetch_assoc();

        if (!is_null($post)) {
            $like = $connect->query("SELECT userId FROM likedposts WHERE userId = $userId AND postId = $postId")->fetch_assoc();

            if (is_null($like)) {
                $connect->query("INSERT INTO likedposts (userId, postId) VALUES ($userId, $postId)");
                setStatus('200', 'OK. Post liked');
            }
            else {
                setStatus('400', 'Post already liked');
            }
        }
        else {
            setStatus('404', 'Post with id = '.$post.' does not exist');
        }
    }
    else {
        setStatus('404', 'User with id = '.$userId.' does not exist');
    }
}

function unlikePost($connect, $postId, $userId) {
    $user = $connect->query("SELECT id FROM users WHERE id = $userId")->fetch_assoc();

    if (!is_null($user)) {
        $post = $connect->query("SELECT id FROM posts WHERE id = $postId")->fetch_assoc();

        if (!is_null($post)) {
            $like = $connect->query("SELECT userId FROM likedposts WHERE userId = $userId AND postId = $postId")->fetch_assoc();

            if (!is_null($like)) {
                $connect->query("DELETE FROM likedposts WHERE userId = $userId AND postId = $postId");
                setStatus('200', "OK. Post unliked");
            }
            else {
                setStatus('400', 'Post already unliked');
            }
        }
        else {
            setStatus('404', 'Post with id = '.$post.' does not exist');
        }
    }
    else {
        setStatus('404', 'User with id = '.$userId.' does not exist');
    }
}

function deletePost($connect, $postId, $yourId) {
    $post = $connect->query("SELECT * FROM posts WHERE id = $postId")->fetch_assoc();

    if (!is_null($post)) {
        if ($post['userId'] != $yourId) {
            setStatus('403', 'You do not have enough rights to delete this post');
            return;
        }

        $connect->query("DELETE FROM posts WHERE id = $postId");
        setStatus('200', "OK. Post deleted");
    }
    else {
        setStatus('404', 'Post with id = '.$postId.' does not exist');
    }
}