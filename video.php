<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/5/26 0026
 * Time: 15:04
 */
require_once 'include/mysqli.class.php';

$videos = $db->getVideos();
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
        for ($i = 0; $i < count($videos); $i ++) {
            $video = $videos[$i];
            $id = $video['id'];
            $name = $video['name'];
            $url = $video['url'];
            $introduction = $video['introduction'];
            $create_time = $video['create_time'];
        ?>
        <div class="video_item">
            <p><?php echo $name; ?></p>
            <embed src='<?php echo $url; ?>' allowFullScreen='true' quality='high' align='middle' allowScriptAccess='always' type='application/x-shockwave-flash'></embed>
            <p class="video_introduction"><?php echo $introduction; ?></p>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<div class="album_footer"></div>
</body>
</html>