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

    /**
     *
     *
     */
    function homeDefault_p()
    {
        include_once __DIR__ . '/../homeDefault.php';
    }

    /**
     *
     * @param $current_page
     */
    function articleList_p($current_page,$get_search_key)
    {
        $search_key = '';
        $post_search_key = isset($_POST['post_search_key']) ? $_POST['post_search_key'] : '';
        if ($post_search_key != '') {
            $search_key = $post_search_key;
        }
        if ($get_search_key != null) {
            $search_key = $get_search_key;
        }
        if ($search_key == '') {
            $sql = "SELECT count(*) FROM article";
        } else {
            $sql = "SELECT count(*) FROM article WHERE keywords LIKE '%{$search_key}%'";
        }

        $mysqli = $this->getMysqli();
        $result = $mysqli->query($sql);
        $count = 0;
        if ($mysqli->affected_rows > 0) {
            $result->data_seek(0);
            $row = $result->fetch_assoc();
            $count = $row['count(*)'];
        } else {
        }
        $total_pages = ceil($count / 10);
        $pre_page = $current_page - 1;
        $next_page = $current_page + 1;

        $list_start = ($current_page - 1) * 10;
        $articles = [];
        if ($search_key == '') {
            $sql = "SELECT * FROM article ORDER BY create_time DESC LIMIT {$list_start},10";
        } else {
            $sql = "SELECT * FROM article WHERE keywords LIKE '%{$search_key}%' ORDER BY create_time DESC LIMIT {$list_start},10";
        }

        $result = $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i ++) {
                $result->data_seek($i);
                $row = $result->fetch_assoc();
                $articles[] = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'article_type' => $row['article_type_id'],
                    'keywords' => $row['keywords'],
                    'introduction' => $row['introduction'],
                    'content' => $row['content'],
                    'view_times' => $row['view_times'],
                    'create_time' => $row['create_time']
                ];
            }
        } else {
//            echo "<script>alert('没查到您想要的结果');history.go(-1);</script>";
//            exit;
        }

        include_once __DIR__ . '/../articleList.php';
    }

    /**
     *
     *
     */
    function writeArticle_p()
    {
        include_once __DIR__ . '/../writeArticle.php';
    }

    /**
     *
     *
     */
    function writeArticle()
    {
        //检查post提交是否成功
        header('Cache-control: private, must-revalidate'); //支持页面回跳,防止提交失败时数据丢失
        if (!isset($_POST['article_title']) || !isset($_POST['article_type']) || !isset($_POST['article_keywords']) ||
            !isset($_POST['article_content'])
        ) {
            echo "<script>alert('文章提交失败，请重新提交！');history.go(-1);</script>";
            exit;
        }

        //将判断文章是否为空的逻辑写在这里，解决提交文章需要按两次提交的bug
        if (empty($_POST['article_content'])) {
            echo "<script>alert('文章内容为空，请填写文章类容！');history.go(-1);</script>";
            exit;
        }
        $articleTitle = $_POST['article_title'];
        $articleType = $_POST['article_type'];
        $articleKeywords = $_POST['article_keywords'];
        $articleIntroduction = $_POST['article_introduction'];
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

        //将单引号转义，防止与sql语句冲突
        $articleContent = str_replace("'","\'", $articleContent);

        //将文章插入数据库
        $sql = "INSERT INTO article(title, article_type_id, keywords, introduction, content, view_times, create_time) VALUES 
                ('{$articleTitle}', '{$articleType}', '{$articleKeywords}', '{$articleIntroduction}', '{$articleContent}', 
                '{$viewTimes}', '{$createTime}')";
        $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            echo "<script>alert('文章保存成功！')</script>";
        } else {
            echo "<script>alert('文章保存失败！');history.go(-1);</script>";
            exit;
        }

        //显示新添加的文章
        $sql = "SELECT id FROM article WHERE title='{$articleTitle}'";
        $result = $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            $result->data_seek(0);
            $row = $result->fetch_assoc();
            $this->showArticle($row['id']);
        }
    }

    /**
     *
     * @param $article_id
     */
    function rewriteArticle_p($article_id)
    {
        $sql = "SELECT * FROM article WHERE id='{$article_id}'";
        $mysqli = $this->getMysqli();
        $result = $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            $result->data_seek(0);
            $row = $result->fetch_assoc();
            $id = $article_id;
            $title = $row['title'];
            $article_type = $row['article_type_id'];
            $keywords = $row['keywords'];
            $introduction = $row['introduction'];
            $content = $row['content'];
            $view_times = $row['view_times'];
            $create_time = $row['create_time'];

            include_once __DIR__ . '/../rewriteArticle.php';
        } else {
            echo "There is no article with the articleID:{$article_id}";
        }
    }

    /**
     *
     *
     */
    function rewriteArticle()
    {
        //检查post提交是否成功k
        header('Cache-control: private, must-revalidate'); //支持页面回跳,防止提交失败时数据丢失
        if (!isset($_POST['article_title']) || !isset($_POST['article_type']) || !isset($_POST['article_keywords']) ||
            !isset($_POST['article_content']) || !isset($_POST['article_id']) || !isset($_POST['view_times'])
            || !isset($_POST['create_time'])
        ) {
            echo "<script>alert('文章提交失败，请重新提交！');history.go(-1);</script>";
            exit;
        }

        //将判断文章是否为空的逻辑写在这里，解决提交文章需要按两次提交的bug
        if (empty($_POST['article_content'])) {
            echo "<script>alert('文章内容为空，请填写文章类容！');history.go(-1);</script>";
            exit;
        }

        $id = $_POST['article_id'];
        $articleTitle = $_POST['article_title'];
        $articleType = $_POST['article_type'];
        $articleKeywords = $_POST['article_keywords'];
        $articleIntroduction = $_POST['article_introduction'];
        $articleContent = $_POST['article_content'];
        $viewTimes = $_POST['view_times'];
        $createTime = $_POST['create_time'];

        //将单引号转义，防止与sql语句冲突
        $articleContent = str_replace("'","\'", $articleContent);

        $mysqli = $this->getMysqli();
        $sql = "UPDATE article SET title='{$articleTitle}',article_type_id='{$articleType}',keywords='{$articleKeywords}', 
                introduction='{$articleIntroduction}',content='{$articleContent}',view_times='{$viewTimes}',
                create_time='{$createTime}' WHERE id='{$id}'";
        $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            echo "<script>alert('修改文章成功！');</script>";
        } else {
            echo "<script>alert('修改文章失败！');history.go(-1);</script>";
            exit;
        }

        $this->showArticle($id);
    }

    /**
     *
     *
     */
    function showArticle_p()
    {

    }

    /**
     *
     * @param $article_id
     */
    function showArticle($article_id)
    {
        $sql = "SELECT * FROM article WHERE id='{$article_id}'";
        $mysqli = $this->getMysqli();
        $result = $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            $result->data_seek(0);
            $row = $result->fetch_assoc();
            $id = $article_id;
            $title = $row['title'];
            $article_type = $row['article_type_id'];
            $keywords = $row['keywords'];
            $introduction = $row['introduction'];
            $content = $row['content'];
            $view_times = $row['view_times'];
            $create_time = $row['create_time'];

            include_once __DIR__ . '/../article.php';
        } else {
            echo "There is no article with the articleID:{}";
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