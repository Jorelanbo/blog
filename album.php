<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/5/26 0026
 * Time: 15:03
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>John Rainbow</title>
    <link rel="stylesheet" href="templates/style/viewer.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        #dowebok {
            width: 700px;
            margin: 0 auto;
            font-size: 0;
        }

        #dowebok li {
            display: inline-block;
            width: 32%;
            margin-left: 1%;
            padding-top: 1%;
        }

        #dowebok li img {
            width: 100%;
        }
    </style>
</head>
<body>
<ul id="dowebok">
    <li><img data-original="admin/templates/images/big_bg1.jpg" src="admin/templates/images/big_bg1.jpg" alt="图片1"></li>
    <li><img data-original="admin/templates/images/big_bg2.jpg" src="admin/templates/images/big_bg2.jpg" alt="图片2"></li>
    <li><img data-original="admin/templates/images/big_bg3.jpg" src="admin/templates/images/big_bg3.jpg" alt="图片3"></li>
    <li><img data-original="admin/templates/images/big_bg4.jpg" src="admin/templates/images/big_bg4.jpg" alt="图片4"></li>
    <li><img data-original="admin/templates/images/big_bg5.jpg" src="admin/templates/images/big_bg5.jpg" alt="图片5"></li>
</ul>
<script src="templates/js/viewer.min.js"></script>
<script>
    var viewer = new Viewer(document.getElementById('dowebok'), {
        url: 'data-original'
    });
</script>
</body>
</html>