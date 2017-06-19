<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/19 0019
 * Time: 17:12
 */
require_once 'include/mysqli.class.php';

$search_key = isset($_GET['search_key']) ? $_GET['search_key'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
if ($search_key == '') {
    echo "<script>alert('查询错误！');history.go(-1);</script>";
    exit;
}
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
            <?php include_once 'searchList.php'?>
        </div>
    </div>

    <div class="menu">
        <div class="search_box">
            <form name="search_form" action="search.php" method="get" onsubmit="return check();">
                <div class="search_title">搜索</div>
                <input title="search_key" name="search_key" class="search_key" placeholder="search key" type="text"><input type="submit" class="submit_search_key" value="　　">
            </form>
        </div>

        <div class="announcement">
            <div class="menu_title">公告</div>
            <div class="announcement_box">
                假如生活欺骗了你，<br>
                不要悲伤，不要心急！<br>
                忧郁的日子里须要镇静：<br>
                相信吧，快乐的日子将会来临！<br>
                心儿永远向往着未来；<br>
                现在却常是忧郁。<br>
                一切都是瞬息，一切都将会过去；<br>
                而那过去了的，就会成为亲切的怀恋。<br>
                ————普希金《假如生活欺骗了你》

            </div>
        </div>

        <div class="newest">
            <div class="menu_title">最新文章</div>
            <div class="newest_list">
                <?php include_once 'newest.php';?>
            </div>
        </div>

        <div class="scan_times_list">
            <div class="menu_title">浏览次数排行</div>
            <div class="high_view_list">
                <?php include_once 'highViewList.php';?>
            </div>
        </div>

        <div class="Jorelanbo">
            <div class="Jorelanbo_box">
                <h2>Jorelanbo</h2><br>
                学习交流。<br>
                QQ：651118767<br>
                微信：thegreatGatesby<br>
                email：Jorelanbo@gmail.com
            </div>
        </div>

        <!--计划添加悬浮简介-->
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

    function check() {
        if (document.search_form.search_key.value === '') {
            return false;
        }
    }
</script>
</body>
</html>