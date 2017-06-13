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
        //检查post提交是否成功
        header('Cache-control: private, must-revalidate'); //支持页面回跳,防止提交失败时数据丢失
        if (!isset($_POST['article_title'])||!isset($_POST['article_type'])||!isset($_POST['article_keywords'])||
            !isset($_POST['article_content'])) {
            echo "<script>alert('文章提交失败，请重新提交！');history.go(-1);</script>";
            exit;
        }
        $articleTitle = $_POST['article_title'];
        $articleType = $_POST['article_type'];
        $articleKeywords = $_POST['article_keywords'];
        $articleContent = $_POST['article_content'];
        $viewTimes = 0;
        $createTime = time();
        $mysqli = $this->getMysqli();

        //检查文章标题是否重复
        $sql = "SELECT id FROM article WHERE title='{$articleTitle}'";
        $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            echo "<script>alert('文章标题已存在，请修改文章标题！');history.go(-1);</script>";
            exit;
        }

        //将文章插入数据库
        $sql = "INSERT INTO article(title, article_type_id, keywords, content, view_times, create_time) VALUES 
                ('{$articleTitle}', '{$articleType}', '{$articleKeywords}', '{$articleContent}', '{$viewTimes}', '{$createTime}')";
        $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            echo "<script>alert('文章保存成功！')</script>";
        } else {
            echo "<script>alert('文章保存失败！')</script>";
        }

        //显示新添加的文章
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
        if ($mysqli->connect_errno) {
            echo "Failed connect to MySql:(" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
        }
        return $mysqli;
    }
}