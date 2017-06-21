<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/21 0021
 * Time: 14:28
 */
if (!isset($_COOKIE['login']) || $_COOKIE['login'] != 1) {
    echo 'access forbidden!';
    exit;
}
echo 'links';