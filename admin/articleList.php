<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/8 0008
 * Time: 14:21
 */
if (!isset($_COOKIE['login']) || $_COOKIE['login'] != 1) {
    echo 'access forbidden!';
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
<body class="article_list_body">
<div class="article_list_box">
    <div class="page_number_list">
        <?php
        if ($current_page != 1) {
            echo "<a class='pre_page' href='index.php?m=admin&a=articleList_p&id={$pre_page}'>上一页</a>";
        }
        for ($i = 0; $i < $total_pages; $i ++) {
            $page_number = $i + 1;
            if ($page_number == $current_page) {
                echo "<a class='page_current_number' href='index.php?m=admin&a=articleList_p&id={$page_number}'>$page_number</a>";
            } else {
                echo "<a class='page_number' href='index.php?m=admin&a=articleList_p&id={$page_number}'>$page_number</a>";
            }
        }
        if ($current_page != $total_pages) {
            echo "<a class='next_page' href='index.php?m=admin&a=articleList_p&id={$next_page}'>下一页</a>";
        }
        ?>
    </div>
</div>
</body>
</html>
