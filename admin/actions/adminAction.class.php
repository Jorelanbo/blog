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
     * @param $get_search_key
     */
    function articleList_p($current_page, $get_search_key)
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
            $sql = "SELECT count(*) FROM article WHERE title LIKE '%{$search_key}%' OR keywords LIKE '%{$search_key}%' OR 
                    introduction LIKE '%{$search_key}%'";
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
            $sql = "SELECT * FROM article WHERE title LIKE '%{$search_key}%' OR keywords LIKE '%{$search_key}%' OR 
                    introduction LIKE '{$search_key}' ORDER BY create_time DESC LIMIT {$list_start},10";
        }

        $result = $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
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
        $articleContent = str_replace("'", "\'", $articleContent);

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
        $articleContent = str_replace("'", "\'", $articleContent);

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

    function removeArticle($article_id)
    {
        $mysqli = $this->getMysqli();
        $sql = "DELETE FROM article WHERE id='$article_id'";
        $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            echo "<script>alert('删除成功！')</script>";
            $this->articleList_p(1, null);
        } else {
            $errno = $mysqli->errno;
            $error = $mysqli->error;
            echo "<script>alert('删除失败：$errno,$error');</script>";
            $this->showArticle($article_id);
        }
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

    function albumList()
    {
        $sql = "SELECT * FROM album";
        $mysqli = $this->getMysqli();
        $result = $mysqli->query($sql);

        if ($mysqli->affected_rows > 0 || $mysqli->errno == 0) {
            $albums = [];
            for ($i = 0; $i < $result->num_rows; $i++) {
                $result->data_seek($i);
                $row = $result->fetch_assoc();
                $albums[] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'introduction' => $row['introduction'],
                    'cover' => $row['cover'],
                    'create_time' => $row['create_time']
                ];
            }
            include_once __DIR__ . '/../album.php';
        } else {
            echo $mysqli->errno . ' : ' . $mysqli->error;
        }
    }

    function addAlbum()
    {
        //检查post提交是否成功
        header('Cache-control: private, must-revalidate'); //支持页面回跳,防止提交失败时数据丢失
        if (!isset($_POST['add_album_name']) || !isset($_POST['add_album_introduction'])) {
            echo "<script>alert('提交错误！');history.go(-1);</script>";
            exit;
        }
        $name = $_POST['add_album_name'];
        $introduction = $_POST['add_album_introduction'];
        $cover = 'http://or9amuuk2.bkt.clouddn.com/album_cover.jpg';
        $create_time = time();

        $mysqli = $this->getMysqli();
        $sql = "INSERT INTO album(name, introduction, cover, create_time) 
                VALUES ('$name', '$introduction', '$cover', '$create_time')";
        $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            echo "<script>alert('相册添加成功！')</script>";
            $this->albumList();
        } else {
            echo $mysqli->errno . ' : ' . $mysqli->error;
        }
    }

    function removeAlbum($album_id)
    {
        $mysqli = $this->getMysqli();
        $sql = "DELETE FROM album WHERE id='$album_id'";
        $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            echo "<script>alert('删除成功！')</script>";
            $this->albumList();
        } else {
            $errno = $mysqli->errno;
            $error = $mysqli->error;
            echo "<script>alert('删除失败：$errno,$error');</script>";
            $this->links_p();
        }
    }

    function photoList($album_id)
    {
        $mysqli = $this->getMysqli();
        $sql = "SELECT id,name,url
                FROM photo
                WHERE album_id=$album_id
                ORDER BY create_time DESC";
        $result = $mysqli->query($sql);

        if ($mysqli->affected_rows > 0 || $mysqli->errno == 0) {
            $photos = [];
            for ($i = 0; $i < $result->num_rows; $i++) {
                $result->data_seek($i);
                $row = $result->fetch_assoc();
                $photos[] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'url' => $row['url']
                ];
            }
            include_once __DIR__ . '/../photoList.php';
        } else {
            echo $mysqli->errno . ' : ' . $mysqli->error;
        }
    }

    function videoList()
    {
        $mysqli = $this->getMysqli();
        $sql = "SELECT * FROM video ORDER BY create_time DESC";
        $result = $mysqli->query($sql);

        if ($mysqli->affected_rows > 0 || $mysqli->errno == 0) {
            $videos = [];
            for ($i = 0; $i < $result->num_rows; $i ++) {
                $result->data_seek($i);
                $row = $result->fetch_assoc();
                $videos[] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'url' => $row['url'],
                    'introduction' => $row['introduction'],
                    'create_time' => $row['create_time']
                ];
            }
            include_once __DIR__ . '/../videoList.php';
        } else {
            echo $mysqli->errno . ' : ' . $mysqli->error;
        }
    }

    function video($video_id)
    {
        $mysqli = $this->getMysqli();
        $sql = "SELECT * FROM video WHERE id='$video_id'";
        $result = $mysqli->query($sql);

        $video = [];
        if ($mysqli->affected_rows > 0) {
            $result->data_seek(0);
            $row = $result->fetch_assoc();
            $video = [
                'id' => $row['id'],
                'name' => $row['name'],
                'url' => $row['url'],
                'introduction' => $row['introduction'],
                'create_time' => $row['create_time']
            ];
            include_once __DIR__ . '/../video.php';
        } else {
            echo $mysqli->errno . ' : ' . $mysqli->error;
        }
    }

    function addVideo()
    {
        //检查post提交是否成功
        header('Cache-control: private, must-revalidate'); //支持页面回跳,防止提交失败时数据丢失
        if (!isset($_POST['add_video_name']) ||
            !isset($_POST['add_video_address']) ||
            !isset($_POST['add_video_introduction'])) {
            echo "<script>alert('提交错误！');history.go(-1);</script>";
            exit;
        }
        $name = $_POST['add_video_name'];
        $url = $_POST['add_video_address'];
        $introduction = $_POST['add_video_introduction'];
        $create_time = time();

        $mysqli = $this->getMysqli();
        $sql = "INSERT INTO video(name, url, introduction, create_time) 
                VALUES ('$name', '$url', '$introduction', '$create_time')";
        $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            echo "<script>alert('视频添加成功！')</script>";
            $this->videoList();
        } else {
            echo $mysqli->errno . ' : ' . $mysqli->error;
        }
    }

    function removeVideo($video_id)
    {
        $mysqli = $this->getMysqli();
        $sql = "DELETE FROM video WHERE id='$video_id'";
        $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            echo "<script>alert('删除成功！')</script>";
            $this->videoList();
        } else {
            $errno = $mysqli->errno;
            $error = $mysqli->error;
            echo "<script>alert('删除失败：$errno,$error');</script>";
            $this->videoList();
        }

    }

    function experience_p()
    {
        include_once __DIR__ . '/../experience.php';
    }

    function master_p($avatar_type = 1)
    {
        $sql = "SELECT * FROM user";
        $mysqli = $this->getMysqli();
        $result = $mysqli->query($sql);

        if ($mysqli->affected_rows > 0) {
            $result->data_seek(0);
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $name = $row['name'];
            $signature = $row['signature'];
            $avatar_path = $row['avatar_path'];

            if (isset($_COOKIE['new_avatar']) && $avatar_type == 2) {
                $avatar_path = $_COOKIE['new_avatar'];
            }
            include_once __DIR__ . '/../master.php';
        } else {
            echo $mysqli->errno . ' : ' . $mysqli->error;
        }
    }

    function updateMaster()
    {
        $id = isset($_POST['master_id']) ? $_POST['master_id'] : 1;
        $name = isset($_POST['master_name']) ? $_POST['master_name'] : 'Jorelanbo';
        $signature = isset($_POST['master_signature']) ? $_POST['master_signature'] : '';
        $avatar_path = isset($_POST['master_avatar_path']) ? $_POST['master_avatar_path'] : 'templates/images/js111.jpg';

        $sql = "UPDATE user SET name='$name',signature='$signature',avatar_path='$avatar_path' WHERE id='$id'";
        $mysqli = $this->getMysqli();
        $mysqli->query($sql);

        if ($mysqli->affected_rows > 0 || $mysqli->errno == 0) {   //当errno等于0时说明是在数据没有改变的情况下提交
            $this->master_p();
        } else {
            echo $mysqli->errno . ' : ' . $mysqli->error;
        }
    }

    function updateAvatar_p()
    {
        require_once __DIR__ . '/../avatar.php';
    }

    function updateAvatar()
    {

    }

    function links_p()
    {
        $sql = "SELECT * FROM links ORDER BY id ASC ";
        $mysqli = $this->getMysqli();
        $result = $mysqli->query($sql);

        if ($mysqli->affected_rows > 0) {
            $links = [];
            for ($i = 0; $i < $result->num_rows; $i++) {
                $result->data_seek($i);
                $row = $result->fetch_assoc();
                $id = $row['id'];
                $name = $row['name'];
                $url = $row['url'];
                $links[] = ['id' => $id, 'name' => $name, 'url' => $url];
            }
            include_once __DIR__ . '/../links.php';
        } else {
            echo $mysqli->errno . ' : ' . $mysqli->error;
        }
    }

    function addLink()
    {
        if (!isset($_POST['add_link_name']) || !isset($_POST['add_link_url'])) {
            echo "<script>alert('提交错误！');history.go(-1);</script>";
            exit;
        }
        $link_name = $_POST['add_link_name'];
        $link_url = $_POST['add_link_url'];

        $mysqli = $this->getMysqli();
        $sql = "INSERT INTO links(name, url) VALUES ('$link_name', '$link_url')";
        $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            echo "<script>alert('友情链接添加成功！')</script>";
            $this->links_p();
        } else {
            echo $mysqli->errno . ' : ' . $mysqli->error;
        }
    }

    function rewriteLink($link_id)
    {
        if (!isset($_POST['rewrite_link_name']) || !isset($_POST['rewrite_link_url'])) {
            echo "<script>alert('提交错误！');history.go(-1);</script>";
            exit;
        }
        $link_name = $_POST['rewrite_link_name'];
        $link_url = $_POST['rewrite_link_url'];

        $mysqli = $this->getMysqli();
        $sql = "UPDATE links SET name='$link_name',url='$link_url' WHERE id='$link_id'";
        $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            echo "<script>alert('友情链接修改成功！')</script>";
            $this->links_p();
        } else {
            echo $mysqli->errno . ' : ' . $mysqli->error;
        }
    }

    function removeLink($link_id)
    {
        $mysqli = $this->getMysqli();
        $sql = "DELETE FROM links WHERE id='$link_id'";
        $mysqli->query($sql);
        if ($mysqli->affected_rows > 0) {
            echo "<script>alert('删除成功！')</script>";
            $this->links_p();
        } else {
            $errno = $mysqli->errno;
            $error = $mysqli->error;
            echo "<script>alert('删除失败：$errno,$error');</script>";
            $this->links_p();
        }
    }

    /**
     * @return mysqli
     * @internal param $sql
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