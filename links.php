<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/21 0021
 * Time: 10:28
 */
$links = $db->getLinks();
?>
<div class="links_list">
<?php
for ($i = 0; $i < count($links); $i ++){
    $name = $links[$i]['name'];
    $url = $links[$i]['url'];
?>
    <a href="<?php echo $url?>" target="_blank"><?php echo $name?></a>
<?php
}
?>
</div>