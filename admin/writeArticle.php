<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/8 0008
 * Time: 14:17
 */
if (!isset($_COOKIE['login']) || $_COOKIE['login'] != 1) {
    echo 'access forbidden!';
    exit;
}
echo '写文章';