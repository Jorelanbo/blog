<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/19 0019
 * Time: 17:40
 */
$articles = $db->getSearchList($page, $search_key);
$article_count = $db->getSearchCount($search_key);
$total_pages = ceil($article_count / 10);
$pre_page = $page - 1;
$next_page = $page + 1;

for ($i = 0; $i < count($articles); $i++) {
    $article = $articles[$i];
    $id = $article['id'];
    $title = $article['title'];
    $create_time = date('Y-m-d H:i:s', $article['create_time']);
    $keywords = $article['keywords'];
    $introduction = $article['introduction'];
    $view_times = $article['view_times'];
    ?>
    <div class="article_item">
        <div class="article_item_title"><a
                href="viewArticle.php?id=<?php echo $id; ?>"><?php echo $title ?></a></div>
        <div class="article_item_info_list">
            <span class="article_writer">john rainbow</span><span
                class="article_create_time"><?php echo $create_time ?></span>
            <span class="keywords"><?php echo $keywords ?></span><span
                class="view_times"><?php echo $view_times ?></span>
        </div>
        <div class="article_item_introduction"><?php echo $introduction ?></div>
        <div class="article_item_divide_line"></div>
    </div>
    <?php
}
?>
<div class="page_number_list">
    <?php
    //分页栏
    if ($total_pages == 1 || $total_pages == 0) {
        echo "<a  class='page_number_1' href='search.php?search_key={$search_key}&page=1'>1</a>";
    } else {
        if ($page != 1) {
            echo "<a class='pre_page' href='search.php?search_key={$search_key}&page={$pre_page}'>上一页</a><a  class='page_number' href='search.php?search_key={$search_key}&page=1'>1</a>";
        } else {
            echo "<a  class='start_page' href='search.php?search_key={$search_key}&page=1'>1</a>";
        }
        for ($i = 1; $i < $total_pages - 1; $i++) {
            $page_number = $i + 1;
            if ($page_number == $page) {
                echo "<a class='page_current_number' href='search.php?search_key={$search_key}&page={$page_number}'>$page_number</a>";
            } else {
                echo "<a class='page_number' href='search.php?search_key={$search_key}&page={$page_number}'>$page_number</a>";
            }
        }
        if ($page != $total_pages) {
            echo "<a class='page_number' href='search.php?search_key={$search_key}&page={$total_pages}'>$total_pages</a><a class='next_page' href='search.php?search_key={$search_key}&page={$next_page}'>下一页</a>";
        } else {
            echo "<a class='end_page' href='search.php?search_key={$search_key}&page={$total_pages}'>$total_pages</a>";
        }
    }
    ?>
</div>