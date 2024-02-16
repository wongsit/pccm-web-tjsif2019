<?php

function connect() {
    $url = 'localhost';
    $user = 'pcshsm_app';
    $password = 'pcshsm_app2019';
    $database = 'pcshsm_tjsif2019';
    $mysqli = new mysqli($url, $user, $password, $database);
    if ($mysqli -> connect_error) {
        return false;
    } else {
        $mysqli->set_charset("utf8");
    }
    return $mysqli;
}


?> 