<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/5/26 0026
 * Time: 15:02
 */
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>John Rainbow</title>
    <link rel="stylesheet" type="text/css" href="templates/style/base.css">
</head>
<body>

<?php
require_once 'header.php';
?>

<div class="content">

    <div class="left_area">
        <div class="main_article">
            文章列表
        </div>
    </div>

    <div class="menu">
        <div class="search_box">
            搜索
        </div>

        <div class="announcement">
            公告
        </div>

        <div class="newest">
            最新文章
        </div>

        <div class="scan_times_list">
            浏览次数排行
        </div>

        <div class="Jorelanbo">
            Jorelanbo
        </div>
    </div>
</div>

<div class="links_box">
    <div class="links">
        友情链接
    </div>
</div>

<div class="footer">footer</div>

<div class="blank"></div>

<script>
    var fix_nav = document.getElementById("fix_nav");
    window.onscroll = function () {
        var t = document.documentElement.scrollTop || document.body.scrollTop;
        if (t > 100) {
            fix_nav.style.zIndex = 3;
        } else {
            fix_nav.style.zIndex = 1;
        }
    }
</script>
</body>
</html>