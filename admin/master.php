<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/21 0021
 * Time: 14:27
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
    <script>
        function check() {
            if (document.master.master_name.value === "" || document.master.master_signature.value === "") {
                return false;
            }
        }
    </script>
</head>
<body class="master_body">
<div class="master_form_box">
    <div class="avatar_box">
        <img src="<?php echo $avatar_path?>">
        <a href="index.php?m=admin&a=updateAvatar_p">修改头像</a>
    </div>
    <form name="master" action="index.php?m=admin&a=updateMaster" method="post" onsubmit="return check();">
        <input type="hidden" id="master_id" name="master_id" title="master_id" value="<?php echo $id;?>" >
        <input type="hidden" id="master_avatar_path" name="master_avatar_path" title="master_avatar_path" value="<?php echo $avatar_path;?>" >
        <label for="master_name">站长昵称：</label><input type="text" name="master_name" id="master_name" value="<?php echo $name;?>"> <br><br>
        <label for="master_signature">站长签名：</label><input type="text" name="master_signature" id="master_signature" value="<?php echo $signature;?>"><br><br><br><br>
        <input type="submit" id="submit" value="更新">　　　<a href="index.php?m=admin&a=master_p" id="reset">恢复</a>
    </form>

</div>
</body>
</html>