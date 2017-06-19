<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/19 0019
 * Time: 11:45
 */
$db->articleView($id);
$article = $db->getArticle($id);
$id = $article['id'];
$title = $article['title'];
$create_time = date('Y-m-d H:i:s', $article['create_time']);
$keywords = $article['keywords'];
$introduction = $article['introduction'];
$content = $article['content'];
$view_times = $article['view_times'];

//echo $view_times."<br>".$content;
?>
<div class="article_detail">
    <div class="article_detail_title">
        <?php echo $title;?>
    </div>
    <div class="article_detail_info_list">
        <span class="article_detail_writer">john rainbow</span><span class="article_detail_create_time"><?php echo $create_time?></span>
        <span class="article_detail_keywords"><?php echo $keywords?></span><span class="article_detail_view_times"><?php echo $view_times?></span>
    </div>
    <div class="article_detail_content">
        <?php echo $content;?>
    </div>
</div>
