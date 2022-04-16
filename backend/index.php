<?php

require 'headers.php';
require 'db_connect.php';
require 'helper.php';
require 'functions.php';

$method = $_SERVER['REQUEST_METHOD'];

$formData = getFormData($method);

$url = (isset($_GET['q'])) ? $_GET['q'] : '';
$url = rtrim($url, '/');
$urls = explode('/', $url);

$router = $urls[0];
$urlData = array_slice($urls, 1);

if (file_exists(realpath(dirname(__FILE__)).'/routers/'.$router.'.php')) {
    include_once 'routers/' . $router . '.php';
    route($method, $urlData, $formData);
}
else {
    setStatus('404', "Route does not exist");
}

mysqli_close($connect);
return;