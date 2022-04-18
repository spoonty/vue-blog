<?php

global $connect;
$connect = mysqli_connect('127.0.0.1', 'root', '', 'vueblog');

if (!$connect) {
    setStatus('500', 'Connection error: '.mysqli_connect_error());
    exit;
}