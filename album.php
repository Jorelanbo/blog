<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/5/26 0026
 * Time: 15:03
 */

require_once 'include/mysqli.class.php';

//$albums = $db->getAlbums();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>John Rainbow</title>
    <link rel="stylesheet" type="text/css" href="templates/style/base.css">
</head>
<body class="album_body">
<div class="album_header">
    <p class="p1">Jorelanbo</p>
    <p class="p2">相册精选</p>
</div>
<div class="album_box">
    <div class="container">
        <?php
        for ($i = 0; $i < 5; $i ++) {
            for ($j = 1; $j <= 5; $j ++) {
        ?>
        <div class="album_item">
            <a href="photos.php?id=<?php echo $i.$j?>" target="_blank">
                <img src="admin/templates/images/big_bg<?php echo $j?>.jpg">
            </a>
            <p>相册<?php echo $j;?></p>
        </div>
        <?php
            }
        }
        ?>
    </div>
</div>
<div class="album_footer"></div>
</body>
</html>