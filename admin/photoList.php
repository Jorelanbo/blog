<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/29 0029
 * Time: 18:19
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
            <label for="add_album_name">相片名称：</label>
            <input type="text" class="add_album_input" name="add_album_name" id="add_album_name"><br><br>
            <label for="add_album_introduction">相册介绍：</label>
            <textarea class="add_album_textarea" name="add_album_introduction" id="add_album_introduction" rows="4" cols="40"></textarea><br><br>
            <input type="submit" id="add_album_submit" value="添加">
        </form>
    </div>
    <div class="albums_body_blank_large"></div>
    <?php
    for ($i = 0; $i < count($photos); $i ++) {
        $photo = $photos[$i];
        $id = $photo['id'];
        $name = $photo['name'];
        $url = $photo['url'];
        ?>
        <div class="item_box">
            <div class="album_item">
                <a href="index.php?m=admin&a=photoList&id=<?php echo $id; ?>"><img src="<?php echo $url;?>"></a>
                <div class="album_content">
                    <div class="album_name"><?php echo $name; ?></div>
                </div>
                <a class="remove" href="index.php?m=admin&a=removeAlbum&id=<?php echo $id; ?>"></a>
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

    /*删除提醒*/
    $(".remove").click(function () {
        var remove = window.confirm("你确定要删除该相册吗？");
        return remove === true;
    });
</script>
</body>
</html>

