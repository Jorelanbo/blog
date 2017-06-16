<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/5/24 0024
 * Time: 11:57
 */

/*
 * 数据库类
 *
 * 在系统所有文件中不需要单独初始化本类
 * 可直接用$db 进行操作
 * 为了防止错误，操作完后不必关闭数据库
 */

//不限制响应时间
@set_time_limit(0);

$db = new Mysql();

class Mysql{
    var $db_host;
    var $db_user;
    var $db_pwd;
    var $db_name;
    var $mysqli;

    function __construct()
    {
        $this->db_host = 'localhost';
        $this->db_user = 'root';
        $this->db_pwd = 'root';
        $this->db_name = 'blog';
        $this->mysqli = @new mysqli($this->db_host, $this->db_user, $this->db_pwd, $this->db_name);
        if ($this->mysqli->connect_errno) {
            echo "Failed connect to MySql:(" . $this->mysqli->connect_errno . ")" . $this->mysqli->connect_error;
        }
    }

    function getArticleCount($article_type = null) {
        if ($article_type == null) {
            $sql = "SELECT count(*) FROM article";
        } else {
            $sql = "SELECT count(*) FROM article WHERE article_type_id=$article_type";
        }
        $result = $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows > 0) {
            $result->data_seek(0);
            $row = $result->fetch_assoc();
            $article_count = $row['count(*)'];
        } else {
            $article_count = 0;
        }
        return $article_count;
    }

    /**
     * 得到站主信息
     *
     * @return array
     */
    function getMaster(){
        $sql = "SELECT * From user";
        $result = $this->mysqli->query($sql);
        $result->data_seek(0);
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $sex = $row['sex'] == 1 ? '男': '女';
        $signature = $row['signature'];
        $avatar_path = $row['avatar_path'];
        $master = ['name'=>$name, 'sex'=>$sex, 'signature'=>$signature, 'avatar_path'=>$avatar_path];
        return $master;
    }

    /**
     * 查找文章列表
     *
     * @param int $current_page
     * @param $typeId
     * @return array
     */
    function getArticles($current_page = 1, $typeId = null)
    {
        $page_start = ($current_page - 1) * 10;
        if ($typeId == null) {
            $sql = "SELECT * FROM article ORDER BY create_time DESC LIMIT {$page_start},10";
        } else {
            $sql = "SELECT * FROM article WHERE article_type_id=$typeId ORDER BY create_time DESC LIMIT {$page_start},10";
        }
        $result = $this->mysqli->query($sql);

        $articles = [];
        if ($this->mysqli->affected_rows > 0) {
            for ($i = 0;$i < $result->num_rows;$i ++) {
                $result->data_seek($i);
                $row = $result->fetch_assoc();
                $articles[] = ['id'=>$row['id'], 'title'=>$row['title'], 'article_type_id'=>$row['article_type_id'],
                    'keywords'=>$row['keywords'], 'introduction'=>$row['introduction'], 'content'=>$row['content'], 'view_times'=>$row['view_times'],
                    'create_time'=>$row['create_time']];
            }
        }

        return $articles;
    }

    /**
     * 得到最新文章（important）
     * @return array
     */
    function getNewest()
    {
        $sql = "SELECT id,title FROM article WHERE keywords LIKE '%important%' ORDER BY create_time DESC LIMIT 10";
        $result = $this->mysqli->query($sql);

        $articles = [];
        if ($this->mysqli->affected_rows > 0) {
            for ($i = 0;$i < $result->num_rows;$i ++) {
                $result->data_seek($i);
                $row = $result->fetch_assoc();
                $articles[] = ['id'=>$row['id'], 'title'=>$row['title']];
            }
        }

        return $articles;
    }

    /**
     * 文章阅读次数加一
     *
     * @param $id
     */
    function articleView($id)
    {
        $sql = "SELECT view_times FROM article WHERE id=$id";
        $result = $this->mysqli->query($sql);
        $result->data_seek(0);
        $row = $result->fetch_assoc();
        $view = $row['view'];
        $view++;
        $sql = "UPDATE article SET view_times = $view WHERE id=$id";
        $this->mysqli->query($sql);
    }
}