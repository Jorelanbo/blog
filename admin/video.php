<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/7/3 0003
 * Time: 12:38
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
</head>
<body class="video_body">
<?php
$id = $video['id'];
$name = $video['name'];
$url = $video['url'];
$introduction = $video['introduction'];
$create_time = $video['create_time'];
?>
<img id="back" class="back" src="templates/images/back.png" style="cursor: pointer">
<div class="show_box">
    <div class="title">
        <?php echo $name; ?>
    </div>
    <embed src='<?php echo $url; ?>' allowFullScreen='true' quality='high' align='middle' allowScriptAccess='always' type='application/x-shockwave-flash'></embed>
    <p><?php echo $introduction; ?></p>
</div>

<div class="video_body_blank"></div>

<script>
    $("#back").click(function () {
        history.go(-1);
    });
</script>
</body>
</html>