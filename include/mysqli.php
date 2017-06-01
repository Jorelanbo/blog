<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/5/24 0024
 * Time: 11:57
 */
$mysqli = @new mysqli('localhost', 'root', 'root', 'blog');
if ($mysqli->connect_errno) {
    echo "Failed connect to MySql:(" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
}