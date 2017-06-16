<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/16 0016
 * Time: 15:30
 */
$newest = $db->getNewest();
for ($i = 0; $i < count($newest); $i ++) {
    $newest_id = $newest[$i]['id'];
    $newest_title = $newest[$i]['title'];
    if ($i == count($newest) - 1) {
?>
        <div class="newest_item">
            <a href="viewArticle.php?id=<?php echo $newest_id;?>"><?php echo $newest_title;?></a>
        </div>
<?php
    } else {
?>
        <div class="newest_item">
            <a href="viewArticle.php?id=<?php echo $newest_id; ?>"><?php echo $newest_title; ?></a>
        </div>
        <div class="newest_item_divide_line"></div>
<?php
    }
}