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
     * 查找指定类型文章
     *
     * @param $typeId
     * @return array
     */
    function getArticles($typeId)
    {
        $sql = "SELECT * FROM article WHERE article_type_id=$typeId";
        $result = $this->mysqli->query($sql);

        $articles = [];

        for ($i = 0;$i < $result->num_rows;$i ++) {
            $result->data_seek($i);
            $row = $result->fetch_assoc();
            $articles[] = ['id'=>$row['id'], 'title'=>$row['title'], 'article_type_id'=>$row['article_type_id'],
                           'keywords'=>$row['keywords'], 'content'=>$row['content'], 'view_times'=>$row['view_times'],
                           'create_time'=>$row['create_time']];
        }
        return $articles;
    }

    /**
     * 倒序查找所有文章
     *
     * @return array
     */
    function getArticleList()
    {
        $sql = "SELECT * FROM article ORDER BY create_time DESC";
        $result = $this->mysqli->query($sql);

        $articles = [];

        for ($i = 0;$i < $result->num_rows;$i ++) {
            $result->data_seek($i);
            $row = $result->fetch_assoc();
            $articles[] = ['id'=>$row['id'], 'title'=>$row['title'], 'article_type_id'=>$row['article_type_id'],
                'keywords'=>$row['keywords'], 'content'=>$row['content'], 'view_times'=>$row['view_times'],
                'create_time'=>$row['create_time']];
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