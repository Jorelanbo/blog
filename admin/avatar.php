<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/22 0022
 * Time: 11:36
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
</head>
<body class="avatar_body">
<div class="avatar_form_box">
    <form action="include/upload/upload_avatar.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="200000">
        <input type="file" id="avatar_file" name="imgFile"><br><br>
        <input type="submit" id="submit" value="上传">
    </form>
</div>
</body>
</html>