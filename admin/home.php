<?php
if (!isset($_COOKIE['login']) || $_COOKIE['login'] != 1) {
    echo "<script>alert('请先登录！');location.href='index.php';</script>";
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
<body class="home_body">

<div class="admin_title">
    <div class="icon"><a href="index.php?m=admin&a=homeDefault_p" target="content_iframe">Jorelanbo</a></div>
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
            <a class="menu_article_button menu_button">　文章</a>
            <ul class="sub">
                <li><a href="index.php?m=admin&a=articleList_p" target="content_iframe">文章列表</a></li>
                <li><a href="index.php?m=admin&a=writeArticle_p" target="content_iframe">写文章</a></li>
            </ul>
        </li>
        <li>
            <a class="menu_album_button menu_button">　相册</a>
            <ul class="sub">
                <li><a href="index.php?m=admin&a=pictureList_p" target="content_iframe">相册列表</a></li>
                <li><a href="index.php?m=admin&a=addPicture_p" target="content_iframe">添加相片</a></li>
            </ul>
        </li>
        <li>
            <a class="menu_video_button menu_button">　视频</a>
            <ul class="sub">
                <li><a href="index.php?m=admin&a=videoList_p" target="content_iframe">视频列表</a></li>
                <li><a href="index.php?m=admin&a=addVideo_p" target="content_iframe">添加视频</a></li>
            </ul>
        </li>
        <li>
            <a class="menu_experience_button menu_button" href="index.php?m=admin&a=experience_p" target="content_iframe">　经验</a>
        </li>
    </ul>
</div>

<div class="admin_content">
    <iframe name="content_iframe" src="index.php?m=admin&a=homeDefault_p">
    </iframe>
</div>

<script>
    $(function () {
        $(".user_box").hover(function () {
            $(this).find("ul").show("fast");
        },function () {
            $(this).find("ul").hide("fast");
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