<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/5/26 0026
 * Time: 15:04
 */
require_once 'include/mysqli.class.php';

//$albums = $db->getVideos();
$src = 'http://player.youku.com/player.php/sid/XODIzNDkwMjM2/v.swf';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>John Rainbow</title>
    <link rel="stylesheet" type="text/css" href="templates/style/base.css">
</head>
<body class="video_body">
<div class="video_header">
    <p class="p1">Jorelanbo</p>
    <p class="p2">视频精选</p>
</div>
<div class="video_box">
    <div class="container">
        <?php
/*        for ($i = 0; $i < 5; $i ++) {
            for ($j = 1; $j <= 5; $j ++) {
                */?><!--
                <div class="video_item">
                    <p>相册<?php /*echo $j;*/?></p>
                </div>
                --><?php
/*            }
        }
        */?>
        <div class="video_item">
            <p>视频1</p>
            <embed src='http://player.youku.com/player.php/sid/XODI2MjE2MzA0/v.swf' allowFullScreen='true' quality='high' align='middle' allowScriptAccess='always' type='application/x-shockwave-flash'></embed>
            <p class="video_introduction">传着一张图片试试传着一张图片试试传着一张图片试试传着一张图片试试传着一张图片试试传着一张图片试试 </p>
        </div>
        <div class="video_item">
            <p>视频2</p>
            <embed src='<?php echo $src?>' allowFullScreen='true' quality='high' align='middle' allowScriptAccess='always' type='application/x-shockwave-flash'></embed>
            <p class="video_introduction">描述2</p>
        </div>
        <div class="video_item">
            <p>视频3</p>
            <embed src='http://player.youku.com/player.php/sid/XODI0MTk3ODQ0/v.swf' allowFullScreen='true' quality='high' align='middle' allowScriptAccess='always' type='application/x-shockwave-flash'></embed>
            <p class="video_introduction">描述3</p>
        </div>
        <div class="video_item">
            <p>视频4</p>
            <embed src='http://player.youku.com/player.php/sid/XODI0ODIxMTEy/v.swf' allowFullScreen='true' quality='high' align='middle' allowScriptAccess='always' type='application/x-shockwave-flash'></embed>
            <p class="video_introduction">描述4</p>
        </div>
        <div class="video_item">
            <p>视频5</p>
            <embed src='http://player.youku.com/player.php/sid/XODI1NTAzNDg0/v.swf' allowFullScreen='true' quality='high' align='middle' allowScriptAccess='always' type='application/x-shockwave-flash'></embed>
            <p class="video_introduction">描述5</p>
        </div>
    </div>
</div>
<div class="album_footer"></div>
</body>
</html>