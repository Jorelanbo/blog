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
    <script>
        /*function check() {
            if(document.search_form.search_key.value === '') {
                return false;
            }
        }*/
    </script>
</head>
<body class="article_list_body">
<div class="article_list_search">
    <form name="search_form" action="index.php?m=admin&a=articleList_p&id=1" method="post" onsubmit="">
        <input title="search_key" name="post_search_key" class="search_key" placeholder="search key" type="text"><input type="submit" class="submit_search_key" value="搜索">
    </form>
</div>
<div class="article_list_box">
    <div class="article_list">
        <?php
        for ($i = 0; $i < count($articles); $i ++) {
            $article = $articles[$i];
            $id = $article['id'];
            $title = $article['title'];
            $create_time = date('Y-m-d H:i:s', $article['create_time']);
            $keywords = $article['keywords'];
            $introduction = $article['introduction'];
            $view_times = $article['view_times'];
        ?>
        <div class="article_item">
            <div class="article_item_title"><a href="index.php?m=admin&a=showArticle&id=<?php echo $id;?>"><?php echo $title?></a></div>
            <div class="article_item_info_list">
                <span class="article_writer">john rainbow</span><span class="article_create_time"><?php echo $create_time?></span>
                <span class="keywords"><?php echo $keywords?></span><span class="view_times"><?php echo $view_times?></span>
            </div>
            <div class="article_item_introduction"><?php echo $introduction?></div>
            <div class="article_item_divide_line"></div>
        </div>
        <?php
        }
        ?>
    </div>
    <div class="page_number_list">
        <?php
        //分页栏
        if ($current_page != 1) {
            echo "<a class='pre_page' href='index.php?m=admin&a=articleList_p&id={$pre_page}&key={$search_key}'>上一页</a>
                  <a class='page_number' href='index.php?m=admin&a=articleList_p&id=1&key={$search_key}'>1</a>";
        } else {
            echo "<a class='start_page' href='index.php?m=admin&a=articleList_p&id=1&key={$search_key}'>1</a>";
        }
        for ($i = 1; $i < $total_pages - 1; $i ++) {
            $page_number = $i + 1;
            if ($page_number == $current_page) {
                echo "<a class='page_current_number' href='index.php?m=admin&a=articleList_p&id={$page_number}&key={$search_key}'>$page_number</a>";
            } else {
                echo "<a class='page_number' href='index.php?m=admin&a=articleList_p&id={$page_number}&key={$search_key}'>$page_number</a>";
            }
        }
        if ($current_page != $total_pages) {
            echo "<a class='page_number' href='index.php?m=admin&a=articleList_p&id={$total_pages}&key={$search_key}'>$total_pages</a>
                  <a class='next_page' href='index.php?m=admin&a=articleList_p&id={$next_page}&key={$search_key}'>下一页</a>";
        } else {
            echo "<a class='end_page' href='index.php?m=admin&a=articleList_p&id={$total_pages}&key={$search_key}'>$total_pages</a>";
        }
        ?>
    </div>
</div>
</body>
</html>
