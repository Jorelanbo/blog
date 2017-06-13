<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/13 0013
 * Time: 11:50
 */

if (!isset($_COOKIE['login']) || $_COOKIE['login'] != 1) {
    echo 'access forbidden!';
    exit;
}

$create_time = date('Y-m-d h:i:s', $create_time);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jorelanbo博客后台</title>
    <link rel="stylesheet" type="text/css" href="templates/style/base_admin.css">
    <script type="text/javascript" src="templates/js/jquery-3.2.1.min.js"></script>
</head>
<body class="article_body">
<div class="article_box">
    <h3 class="article_title"><?php echo $title?></h3>
    <div class="article_info_list">
        <span class="article_writer">john rainbow</span><span class="article_create_time"><?php echo $create_time?></span>
        <span class="keywords"><?php echo $keywords?></span><span class="view_times"><?php echo $view_times?></span>
        <a class="rewrite" href="index.php?m=admin&a=rewriteArticle_p&id=<?php echo $id?>"></a>
    </div>
    <div class="article_content">
        <?php echo $content ?>
    </div>
</div>
</body>
</html>
