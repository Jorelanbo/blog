<?php

/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/6 0006
 * Time: 10:23
 */
class adminAction
{
    function __construct()
    {
        if (!isset($_COOKIE['login']) || $_COOKIE['login'] != 1) {
            echo "<script>alert('非法登录！');location.href='index.php';</script>";
            exit;
        }
    }

    function index()
    {
        require_once __DIR__.'/../home.html';
    }
}