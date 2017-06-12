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

    function writeArticle()
    {
        $articleTitle = $_POST['article_title'];
        $articleType = $_POST['article_type'];
        $articleKeywords = $_POST['article_keywords'];
        $articleContent = $_POST['article_content'];
        $viewTimes = 0;
        $createTime = time();
        $sql = "INSERT INTO article(title, article_type_id, keywords, content, view_times, create_time) VALUES 
                ('{$articleTitle}', '{$articleType}', '{$articleKeywords}', '{$articleContent}', '{$viewTimes}', '{$createTime}')";
        $mysqli = $this->getMysqli();
        $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            echo "<script>alert('文章保存成功！')</script>";
        } else {
            echo "<script>alert('文章保存失败！')</script>";
        }
        $sql = "SELECT content FROM article WHERE title='{$articleTitle}'";
        $result = $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            $result->data_seek(0);
            $row = $result->fetch_assoc();
            echo $row['content'];
        }
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
     * @return mysqli
     */
    function getMysqli()
    {
        $mysqli = new mysqli('localhost', 'root', 'root', 'blog');
        return $mysqli;
    }
}