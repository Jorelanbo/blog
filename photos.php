<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/28 0028
 * Time: 14:32
 */
require_once 'include/mysqli.class.php';
if (!isset($_GET['id'])) {
    echo 'network error!';
}

$id = $_GET['id'];

//$photos = $db->getPhotos($id);
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Jorelanbo--相册</title>
    <script src="templates/js/jq_viewer/layer/jquery.js?v=1.83.min"></script>
    <script src="templates/js/jq_viewer/layer/layer.min.js"></script>
    <style>
        html{background-color:#E3E3E3; font-size:14px; color:#000; font-family:'微软雅黑',serif}
        a,a:hover{ text-decoration:none;}
        pre{font-family:'微软雅黑',serif}
        .box{padding:20px; background-color:#fff; margin:20px 100px; border-radius:5px;}
        .box a{padding-right:15px;}
        #about_hide{display:none}
        .layer_text{background-color:#fff; padding:20px;}
        .layer_text p{margin-bottom: 10px; text-indent: 2em; line-height: 23px;}
        .button{display:inline-block; *display:inline; *zoom:1; line-height:30px; padding:0 20px; background-color:#56B4DC; color:#fff; font-size:14px; border-radius:3px; cursor:pointer; font-weight:normal;}
        .imgs img{width:300px;padding:0 20px 20px;}
    </style>
</head>
<body>
<div class="box">
    <h2 style="padding-bottom:20px;"><?php echo '那年花开'; ?></h2>
    <div id="imgs" class="imgs">
        <img src="templates/images/big_bg1.jpg" layer-pname="HTML5资源教程 - 1">
        <img src="templates/images/big_bg2.jpg" layer-pname="HTML5资源教程 - 1">
    </div>
    <div style="text-align:center;clear:both;">
    </div>
</div>
<script>
    !function(){
        layer.use('extend/layer.ext.js', function(){
            //初始加载即调用，所以需放在ext回调里
            layer.ext = function(){
                layer.photosPage({
                    html:'<div style="padding:20px;"><p><?php echo "某年某月"?></p></div>',
                    title: "<?php echo '那年花开'?>",
                    id: 100, //相册id，可选
                    parent:'#imgs'
                });
            };
        });
    }();
</script>

</body>
</html>
