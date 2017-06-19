<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/19 0019
 * Time: 15:25
 */
$high_views = $db->getHighViewList();
for ($i = 0; $i < count($high_views); $i ++) {
    $high_view_id = $high_views[$i]['id'];
    $high_view_title = $high_views[$i]['title'];
    $high_view_view_times = $high_views[$i]['view_times'];

    if ($i == count($high_views) - 1) {
        ?>
        <div class="high_view_item">
            <a href="viewArticle.php?id=<?php echo $high_view_id;?>"><?php echo $high_view_title;?></a>
            <div class="times"><?php echo $high_view_view_times;?></div>
        </div>
        <?php
    } else {
        ?>
        <div class="high_view_item">
            <a href="viewArticle.php?id=<?php echo $high_view_id; ?>" title="<?php echo $high_view_title; ?>"><?php echo $high_view_title; ?></a>
            <div class="times"><?php echo $high_view_view_times;?></div>
        </div>
        <div class="high_view_item_divide_line"></div>
        <?php
    }
}