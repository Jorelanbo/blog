<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/5/26 0026
 * Time: 15:02
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>John Rainbow</title>
    <link rel="stylesheet" type="text/css" href="templates/style/base.css">
</head>
<body>

<?php
require_once 'header.php';
?>

<div class="content">
    content
</div>

<div class="footer">footer</div>


<script>
    var fix_nav = document.getElementById("fix_nav");
    window.onscroll = function () {
        var t = document.documentElement.scrollTop || document.body.scrollTop;
        if (t > 100) {
            fix_nav.style.zIndex = 3;
        } else {
            fix_nav.style.zIndex = 1;
        }
    }
</script>
</body>
</html>