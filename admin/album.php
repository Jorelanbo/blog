<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/8 0008
 * Time: 14:26
 */
if (!isset($_COOKIE['login']) || $_COOKIE['login'] != 1) {
    echo 'access forbidden!';
    exit;
}

$default_cover = 'http://or9amuuk2.bkt.clouddn.com/album_cover.jpg';
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
            if (document.add_album_form.add_album_name.value === '' || document.add_album_form.add_album_introduction.value === '') {
                alert("哥，填完整再加。");
                return false;
            }
        }

        function checkRewrite() {
            if (document.rewrite_album_form.rewrite_album_name.value === '' || document.rewrite_album_form.rewrite_album_introduction.value === '') {
                alert("哥，填完整再改。");
                return false;
            }
        }
    </script>
</head>
<body class="albums_body">
<div class="albums_body_blank"></div>
<div class="albums_list">
    <div class="albums_body_blank">
        <a class="add_album" id="add_album"></a>
    </div>
    <div id="add_album_box">
        <form name="add_album_form" action="index.php?m=admin&a=addAlbum" method="post" onsubmit="return checkAdd();">
            <label for="add_album_name">相册名称：</label>
            <input type="text" class="add_album_input" name="add_album_name" id="add_album_name"><br><br>
            <label for="add_album_introduction">相册介绍：</label>
            <textarea class="add_album_textarea" name="add_album_introduction" id="add_album_introduction" rows="4" cols="40"></textarea><br><br>
            <input type="submit" id="add_album_submit" value="添加">
        </form>
    </div>
    <div class="albums_body_blank_large"></div>
<?php
for ($i = 0; $i < count($albums); $i ++) {
    $album = $albums[$i];
    $id = $album['id'];
    $name = $album['name'];
    $introduction = $album['introduction'];
    $cover = $album['cover'];
    $create_time = $album['create_time']
    ?>
    <div class="item_box">
        <div class="album_item">
            <a href="index.php?m=admin&a=photoList&id=<?php echo $id; ?>"><img src="<?php echo $cover;?>"></a>
            <div class="album_content">
                <div class="album_name"><?php echo $name; ?></div>
                <div class="album_introduction"><?php echo $introduction?></div>
            </div>
            <a class="remove" href="index.php?m=admin&a=removeAlbum&id=<?php echo $id; ?>"></a>
            <a class="rewrite"></a>
        </div>
        <div class="album_rewrite_item">
            <form name="rewrite_album_form" action="index.php?m=admin&a=rewriteAlbum&id=<?php echo $id; ?>" method="post" onsubmit="return checkRewrite();">
                <label for="rewrite_album_name">相册名称：</label>
                <input type="text" class="rewrite_album_input" name="rewrite_album_name" id="rewrite_album_name" value="<?php echo $name; ?>"><br>
                <label for="rewrite_album_introduction">相册介绍(不多于60个字符)：</label><br>
                <textarea class="rewrite_album_textarea" name="rewrite_album_introduction" id="rewrite_album_introduction" rows="4" cols="40"><?php echo $introduction; ?></textarea><br>
                <input type="submit" id="rewrite_album_submit" value="修改">　<span>取消</span>
            </form>
        </div>
    </div>
    <?php
}
?>
<div class="albums_body_blank"></div>
</div>
<div class="albums_body_blank"></div>

<script>
    /*添加*/
    $("#add_album").click(function () {
        var add_box = $("#add_album_box");
        if (add_box.css("display") === "none") {
            add_box.show("fast", "swing");
        } else {
            add_box.hide("fast", "swing");
        }
    });

    /*修改*/
    $(".rewrite").click(function () {
        var rewrite_item =  $(this).parents(".item_box").find(".album_rewrite_item");
        var link_item = $(this).parents(".item_box").find(".album_item");
        var other_rewrite_items = $(this).parents(".item_box").siblings().find(".album_rewrite_item");
        var other_link_items = $(this).parents(".item_box").siblings().find(".album_item");
        if (rewrite_item.css("display") === "none") {
            other_rewrite_items.hide(100);
            other_link_items.show(100);
            link_item.hide(200);
            rewrite_item.show(200);
        }
    });

    /*取消修改*/
    $(".album_rewrite_item span").click(function () {
        var rewrite_item =  $(this).parents(".item_box").find(".album_rewrite_item");
        var link_item = $(this).parents(".item_box").find(".album_item");
        if (link_item.css("display") === "none") {
            rewrite_item.hide(200);
            link_item.show(200);
        }
    });

    /*删除提醒*/
    $(".remove").click(function () {
        var remove = window.confirm("你确定要删除该相册吗？");
        return remove === true;
    });
</script>
</body>
</html>
