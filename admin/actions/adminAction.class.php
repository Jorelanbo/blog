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
            echo "<script>alert('请先登录！');location.href='index.php';</script>";
            exit;
        }
    }

    function index()
    {
        include_once __DIR__ . '/../home.php';
    }

    function homeDefault_p()
    {
        include_once __DIR__ . '/../homeDefault.php';
    }

    function articleList_p()
    {
        include_once __DIR__ . '/../articleList.php';
    }

    function writeArticle_p()
    {
        include_once __DIR__ . '/../writeArticle.php';
    }

    function pictureList_p()
    {
        include_once __DIR__ . '/../pictureList.php';
    }

    function addPicture_p()
    {
        include_once __DIR__ . '/../addPicture.php';
    }

    function videoList_p()
    {
        include_once __DIR__ . '/../videoList.php';
    }

    function addVideo_p()
    {
        include_once __DIR__ . '/../addVideo.php';
    }

    function experience_p()
    {
        include_once __DIR__ . '/../experience.php';
    }

    /**
     * @param $sql
     * @return bool sql语句是否执行成功
     */
    function query($sql)
    {
        $mysqli = new mysqli('localhost', 'root', 'root', 'blog');
        $mysqli->query($sql);
        return $mysqli->affected_rows > 0;
    }
}