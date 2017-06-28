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

class Mysql
{
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
    function getMaster()
    {
        $sql = "SELECT * FROM user";
        $result = $this->mysqli->query($sql);
        $result->data_seek(0);
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $sex = $row['sex'] == 1 ? '男' : '女';
        $signature = $row['signature'];
        $avatar_path = $row['avatar_path'];
        $master = ['name' => $name, 'sex' => $sex, 'signature' => $signature, 'avatar_path' => $avatar_path];
        return $master;
    }

    function getLinks()
    {
        $sql = "SELECT name,
                       url 
                FROM links 
                ORDER BY id ASC";
        $result = $this->mysqli->query($sql);

        $links = [];
        if ($this->mysqli->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $result->data_seek($i);
                $row = $result->fetch_assoc();
                $links[] = [
                    'name' => $row['name'],
                    'url' => $row['url']
                ];
            }
        } else {
            echo $this->mysqli->errno . ' :' . $this->mysqli->error;
        }

        return $links;
    }

    /**
     * 获取文章的数目，可以根据文章类型获取
     * @param null $article_type
     * @return int
     */
    function getArticleCount($article_type = null)
    {
        if ($article_type == null) {
            $sql = "SELECT count(*) 
                    FROM article";
        } else {
            $sql = "SELECT count(*) 
                    FROM article 
                    WHERE article_type_id=$article_type";
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
            $sql = "SELECT * 
                    FROM article 
                    ORDER BY create_time 
                    DESC LIMIT $page_start,10";
        } else {
            $sql = "SELECT * 
                    FROM article 
                    WHERE article_type_id=$typeId 
                    ORDER BY create_time 
                    DESC LIMIT $page_start,10";
        }
        $result = $this->mysqli->query($sql);

        $articles = [];
        if ($this->mysqli->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $result->data_seek($i);
                $row = $result->fetch_assoc();
                $articles[] = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'article_type_id' => $row['article_type_id'],
                    'keywords' => $row['keywords'],
                    'introduction' => $row['introduction'],
                    'content' => $row['content'],
                    'view_times' => $row['view_times'],
                    'create_time' => $row['create_time']
                ];
            }
        } else {
            echo $this->mysqli->errno . ' :' . $this->mysqli->error;
        }

        return $articles;
    }

    /**
     * 得到最新文章（important）
     * @return array
     */
    function getNewest()
    {
        $sql = "SELECT id,
                      title 
                FROM article 
                WHERE keywords 
                LIKE '%important%' 
                ORDER BY create_time 
                DESC LIMIT 10";
        $result = $this->mysqli->query($sql);

        $articles = [];
        if ($this->mysqli->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $result->data_seek($i);
                $row = $result->fetch_assoc();
                $articles[] = [
                    'id' => $row['id'],
                    'title' => $row['title']
                ];
            }
        } else {
            echo $this->mysqli->errno . ' :' . $this->mysqli->error;
        }

        return $articles;
    }

    /**
     * 根据文章id显示文章详情内容
     * @param $id
     * @return array
     */
    function getArticle($id)
    {
        $sql = "SELECT * 
                FROM article 
                WHERE id='$id'";
        $result = $this->mysqli->query($sql);

        $article = [];
        if ($this->mysqli->affected_rows > 0) {
            $result->data_seek(0);
            $row = $result->fetch_assoc();
            $article = [
                'id' => $row['id'],
                'title' => $row['title'],
                'article_type_id' => $row['article_type_id'],
                'keywords' => $row['keywords'],
                'introduction' => $row['introduction'],
                'content' => $row['content'],
                'view_times' => $row['view_times'],
                'create_time' => $row['create_time']
            ];
        } else {
            echo $this->mysqli->errno . ' :' . $this->mysqli->error;
        }

        return $article;
    }

    /**
     * 得到被浏览次数最高的十篇文章
     * @return array
     */
    function getHighViewList()
    {
        $sql = "SELECT id,
                       title,
                       view_times 
                FROM article 
                ORDER BY view_times 
                DESC LIMIT 10";
        $result = $this->mysqli->query($sql);

        $articles = [];
        if ($this->mysqli->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $result->data_seek($i);
                $row = $result->fetch_assoc();
                $articles[] = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'view_times' => $row['view_times']
                ];
            }
        } else {
            echo $this->mysqli->errno . ' :' . $this->mysqli->error;
        }

        return $articles;
    }

    /**
     * 得到文章标题或者关键词中含有$search_key的文章
     * @param int $current_page
     * @param $search_key
     * @return array
     */
    function getSearchList($current_page = 1, $search_key)
    {
        $page_start = ($current_page - 1) * 10;
        $sql = "SELECT id,
                       title,
                       article_type_id,
                       keywords,introduction,
                       view_times,
                       create_time 
                FROM article 
                WHERE title LIKE '%$search_key%' OR 
                      keywords LIKE '%$search_key%' OR 
                      introduction LIKE '%$search_key%' 
                ORDER BY create_time 
                DESC LIMIT $page_start,10";
        $result = $this->mysqli->query($sql);

        $articles = [];
        if ($this->mysqli->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $result->data_seek($i);
                $row = $result->fetch_assoc();
                $articles[] = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'keywords' => $row['keywords'],
                    'introduction' => $row['introduction'],
                    'view_times' => $row['view_times'],
                    'create_time' => $row['create_time']
                ];
            }
        } else {
            echo $this->mysqli->errno . ' :' . $this->mysqli->error;
        }

        return $articles;
    }

    /**
     * 得到文章标题或者关键词中含有$search_key的文章的数目
     * @param $search_key
     * @return int
     */
    function getSearchCount($search_key)
    {
        $sql = "SELECT count(*) 
                FROM article 
                WHERE title LIKE '%$search_key%' OR 
                      keywords LIKE '%$search_key%' OR 
                      introduction LIKE '$search_key' 
                ORDER BY create_time DESC";
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
     * 文章阅读次数加一
     *
     * @param $id
     */
    function articleView($id)
    {
        $mysqli = $this->mysqli;
        $sql = "UPDATE article 
                SET view_times=view_times + 1 
                WHERE id=$id";
        $mysqli->query($sql);
        if ($mysqli->affected_rows <= 0) {
            echo $mysqli->errno . ' :' . $mysqli->error;
        }
    }

    /**
     * 获取所有相册
     *
     * @return array
     */
    function getAlbums()
    {
        $mysqli = $this->mysqli;
        $sql = "SELECT * FROM album";
        $result = $mysqli->query($sql);

        $albums = [];
        if ($mysqli->affected_rows > 0) {
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
        } else {
            echo $mysqli->errno . ' :' . $mysqli->error;
        }

        return $albums;
    }

    /**
     * 根据id获取相册中的所有相片
     *
     * @param $album_id
     * @return array
     */
    function getPhotos($album_id)
    {
        $mysqli = $this->mysqli;
        $sql = "SELECT * 
                FROM photo 
                WHERE album_id='$album_id'";
        $result = $mysqli->query($sql);

        $photos = [];
        if ($mysqli->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $result->data_seek($i);
                $row = $result->fetch_assoc();
                $photos[] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'album_id' => $row['album_id'],
                    'url' => $row['url'],
                    'create_time' => $row['create_time']
                ];
            }
        } else {
            echo $mysqli->errno . ' :' . $mysqli->error;
        }

        return $photos;
    }
}