<?php

/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/6 0006
 * Time: 10:22
 */
class userAction
{
    function index()
    {
        if (isset($_COOKIE['login']) && $_COOKIE['login'] == 1) {
            header("location:index.php?m=admin");
            exit;
        }
        include __DIR__ . '/../login.html';
    }

    function login_h()
    {
        if (isset($_COOKIE['login']) && $_COOKIE['login'] == 1) {
            header("location:" . __DIR__ . "/../index.php?m=admin");
            exit;
        }
        include __DIR__ . '/../login.html';
    }

    function reg_h()
    {
        include __DIR__ . '/../reg.html';
    }

    function login()
    {
        $uname = isset($_POST['uname']) ? $_POST['uname'] : '';
        $upwd = isset($_POST['upwd']) ? $_POST['upwd'] : '';
        $md5_upwd = md5($upwd.'jorelanbo');
        $ctime = time() + 3600;
        echo "<script>console.log($md5_upwd)</script>";
        $sql = "SELECT id FROM admin WHERE name='{$uname}' AND password='{$md5_upwd}'";
        if ($this->query($sql)) {
            setcookie('uname', $uname, $ctime);
            setcookie('login', 1, $ctime);
            header("location:index.php?m=admin");
            exit;
        } else {
            echo "<script>alert('登录失败！');window.location.href='login.html';</script>";
            exit;
        }
    }

    function reg()
    {
        $uname = isset($_POST['uname']) ? $_POST['uname'] : '';
        $upwd = isset($_POST['upwd']) ? $_POST['upwd'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $qq = isset($_POST['qq']) ? $_POST['qq'] : '';
        $ctime = time() + 3600;
        if ($uname == '' || $upwd == '' || $email == '' || $qq == '') {
            echo "<script>alert('存在空的注册信息！请重新填写！');history.go(-1);</script>";
            exit;
        }
        $sql = "SELECT id FROM admin WHERE name='{$uname}'";
        if ($this->query($sql)) {
            echo "<script>alert('用户存在');history.go(-1);</script>";
            exit;
        }
        $md5_upwd = md5($upwd.'jorelanbo');
        $sql = "INSERT INTO admin(name, password, email, QQ) VALUES('{$uname}', '{$md5_upwd}', '{$email}', '{$qq}') ";

        if ($this->query($sql)) {
            setcookie('uname', $uname, $ctime);
            setcookie('login', 1, $ctime);
            header("location:index.php?m=admin");
            exit;
        } else {
            echo "<script>alert('注册失败！');history.go(-1);</script>";
            exit;
        }
    }

    function quit() {
        setcookie('uname', '', 1);
        setcookie('login', '', 1);
        header("location:index.php");
        exit();
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