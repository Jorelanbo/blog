<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/21 0021
 * Time: 14:28
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
            if (document.add_link_form.add_link_name.value === '' || document.add_link_form.add_link_url.value === '') {
                alert("哥，填完整再加。");
                return false;
            }
        }

        function checkRewrite() {
            if (document.add_link_form.rewrite_link_name.value === '' || document.add_link_form.rewrite_link_url.value === '') {
                alert("哥，填完整再改。");
                return false;
            }
        }
    </script>
</head>
<body class="links_body">
<div class="links_body_blank"></div>
<div class="links_list">
    <div class="links_body_blank">
        <a class="add_link" id="add_link"></a>
    </div>
    <div id="add_link_box">
        <form name="add_link_form" action="index.php?m=admin&a=addLink" method="post" onsubmit="return checkAdd();">
            <label for="add_link_name">网站名称：</label><input type="text" class="add_link_input" name="add_link_name" id="add_link_name">
            　　　<label for="add_link_url">网站地址：</label><input type="text" class="add_link_input" name="add_link_url" id="add_link_url">
            　　　<input type="submit" id="add_link_submit" value="添加">
        </form>
    </div>
    <div class="links_body_blank"></div>
<?php
for ($i = 0; $i < count($links); $i ++) {
    $link = $links[$i];
    $id = $link['id'];
    $name = $link['name'];
    $url = $link['url'];
?>
    <div class="item">
        <div class="link_item">
            <div class="link_name"><?php echo $name; ?></div>
            <a class="link_url" href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a>
            <a class="rewrite"></a>
            <a class="remove" href="index.php?m=admin&a=removeLink&id=<?php echo $id; ?>"></a>
        </div>
        <div class="link_rewrite_item">
            <form name="rewrite_link_form" action="index.php?m=admin&a=rewriteLink&id=<?php echo $id; ?>" method="post" onsubmit="return check();">
                　　<label for="rewrite_link_name">网站名称：</label>
                <input type="text" class="rewrite_link_input" name="rewrite_link_name" id="rewrite_link_name" value="<?php echo $name; ?>">
                　　<label for="rewrite_link_url">网站地址：</label>
                <input type="text" class="rewrite_link_input" name="rewrite_link_url" id="rewrite_link_url" value="<?php echo $url; ?>">
                　　<input type="submit" id="rewrite_link_submit" value="修改">　<span>取消</span>
            </form>
        </div>
    </div>
<?php
}
?>
    <div class="links_body_blank"></div>
</div>
<div class="links_body_blank"></div>

<script>
    $("#add_link").click(function () {
        var add_box = $("#add_link_box");
        if (add_box.css("display") === "none") {
            add_box.show("fast", "swing");
        } else {
            add_box.hide("fast", "swing");
        }
    });

    /*修改*/
    $(".rewrite").click(function () {
        var rewrite_item =  $(this).parents(".item").find(".link_rewrite_item");
        var link_item = $(this).parents(".item").find(".link_item");
        var other_rewrite_items = $(this).parents(".item").siblings().find(".link_rewrite_item");
        var other_link_items = $(this).parents(".item").siblings().find(".link_item");
        if (rewrite_item.css("display") === "none") {
            other_rewrite_items.hide(100);
            other_link_items.show(100);
            link_item.hide(200);
            rewrite_item.show(200);
        }
    });

    /*取消修改*/
    $(".link_rewrite_item span").click(function () {
        var rewrite_item =  $(this).parents(".item").find(".link_rewrite_item");
        var link_item = $(this).parents(".item").find(".link_item");
        if (link_item.css("display") === "none") {
            rewrite_item.hide(200);
            link_item.show(200);
        }
    });
</script>
</body>
</html>
