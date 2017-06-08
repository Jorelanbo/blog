<?php
if (!isset($_COOKIE['login']) || $_COOKIE['login'] != 1) {
    echo "<script>alert('非法登录！');location.href='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jorelanbo博客后台</title>
    <link rel="stylesheet" type="text/css" href="templates/style/base_admin.css">
    <script type="text/javascript" src="templates/js/jquery-3.2.1.min.js"></script>
</head>
<body>

<div class="admin_title">
    <div class="icon">Jorelanbo</div>
    <div class="user_box">
        <a class="user"> <span><?=$_COOKIE['uname'] ?></span></a>
        <ul>
            <li><a>MyAccount</a></li>
            <li><a href="index.php?m=user&a=quit">安全退出</a></li>
        </ul>
    </div>

</div>

<div class="admin_menu">
    <ul class="upper">
        <li>
            <a class="menu_button">　文章</a>
            <ul class="sub">
                <li><a href="http://www.baidu.com" target="content_iframe">文章列表</a></li>
                <li><a>写文章</a></li>
            </ul>
        </li>
        <li>
            <a class="menu_button">　相册</a>
            <ul class="sub">
                <li><a>相册列表</a></li>
                <li><a>添加相片</a></li>
            </ul>
        </li>
        <li>
            <a class="menu_button">　视频</a>
            <ul class="sub">
                <li><a>视频列表</a></li>
                <li><a>添加视频</a></li>
            </ul>
        </li>
        <li>
            <a class="menu_button">　经验</a>
        </li>
    </ul>
</div>

<div class="admin_content">
    <iframe name="content_iframe">
    </iframe>
</div>

<script>
    $(function () {
        $(".user_box").hover(function () {
            $(this).find("ul").show("normal");
        },function () {
            $(this).find("ul").hide("normal");
        });

        $("a.menu_button").click(function () {
            var list = $(this).parent().find("ul.sub");
            if (list.css("display") === "none") {
                list.show("fast", "swing");
            } else {
                list.hide("fast", "swing");
            }

        });
    });
</script>
</body>
</html>