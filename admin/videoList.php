<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/8 0008
 * Time: 15:05
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
    <script>
        function checkAdd() {
            if (document.add_video_form.add_video_name.value === '' ||
                document.add_video_form.add_video_address.value === '' ||
                document.add_video_form.add_video_introduction.value === '') {
                alert("哥，填完整再加。");
                return false;
            }
        }
    </script>
</head>
<body class="videos_body">
<div class="videos_body_blank"></div>
<div class="videos_list">
    <div class="videos_body_blank">
        <a class="add_video" id="add_video"></a>
    </div>
    <div id="add_video_box">
        <form name="add_video_form" action="index.php?m=admin&a=addVideo" method="post" onsubmit="return checkAdd();">
            <label for="add_video_name">视频名称：</label>
            <input type="text" class="add_video_input" name="add_video_name" id="add_video_name"><br><br>
            <label for="add_video_address">视频地址：</label>
            <input type="text" class="add_video_input" name="add_video_address" id="add_video_address"><br><br>
            <label for="add_video_introduction">介绍介绍(长度不超过60)：</label><br>
            <textarea class="add_video_textarea" name="add_video_introduction" id="add_video_introduction"></textarea><br><br>
            <input type="submit" id="add_video_submit" value="添加">
        </form>
    </div>
    <div class="videos_body_blank_large"></div>
<?php
for ($i = 0; $i < count($videos); $i ++) {
    $video = $videos[$i];
    $id = $video['id'];
    $name = $video['name'];
    $url = $video['url'];
    $introduction = $video['introduction'];
    $create_time = $video['create_time']
    ?>
    <div class="item_box">
        <div class="video_item">
            <div class="video_content">
                <a class="video_name" href="index.php?m=admin&a=video&id=<?php echo $id; ?>"><?php echo $name;?></a>
                <div class="video_introduction"><?php echo $introduction?></div>
            </div>
            <a class="remove" href="index.php?m=admin&a=removeVideo&id=<?php echo $id; ?>"></a>
        </div>
    </div>
<?php
}
?>
<div class="videos_body_blank"></div>
</div>
<div class="videos_body_blank"></div>

<script>
    /*添加*/
    $("#add_video").click(function () {
        var add_box = $("#add_video_box");
        if (add_box.css("display") === "none") {
            add_box.show("fast", "swing");
        } else {
            add_box.hide("fast", "swing");
        }
    });

    /*删除提醒*/
    $(".remove").click(function () {
        var remove = window.confirm("你确定要删除该视频吗？");
        return remove === true;
    });
</script>
</body>
</html>