<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/5/26 0026
 * Time: 14:11
 */
require_once 'common/common.inc.php';
$dayArray = ['', '一', '二', '三', '四', '五', '六', '日'];
$day = $dayArray[date('N')];
$date = "今天是" . date('Y年m月d日') . "，星期" . $day;
$sql = "SELECT * From user";
$result = $mysqli->query($sql);
$result->data_seek(0);
$row = $result->fetch_assoc();
$name = $row['name'];
$sex = $row['sex'] == 1 ? '男': '女';
$signature = $row['signature'];
$avatar_path = $row['avatar_path'];
//echo "<script>alert('这是一个{$sex}人！')</script>";
?>
<div class="box">

    <div class="header">

        <div class="avatar_area">

            <a href=""><img class="avatar" src="<?=$avatar_path?>"></a>

            <div class="name_signature">
                <a href=""><h2 id="name"><?=$name?></h2></a>
                <h5 id="signature"><?=$signature?></h5>
            </div>
        </div>

        <h6 class="date"><?=$date?></h6>
    </div>

    <!--固定导航栏-->
    <div class="divider"></div>
    <div class="nav_bg">
        <div class="nav">
            <ul>
                <li class="home"><a href="index.php">首页</a></li>
                <li class="life"><a href="life.php">生活</a></li>
                <li class="skill"><a href="skill.php">技术</a></li>
                <li class="album"><a href="album.php" target="_blank">相册</a></li>
                <li class="video"><a href="video.php" target="_blank">视频</a></li>
                <li class="experience"><a href="experience.php" target="_blank">经验</a></li>
                <li class="about"><a href="about.php">关于本站</a></li>
            </ul>
        </div>
    </div>

    <div class="divider"></div>

</div>

<!--悬浮导航栏-->
<div class="fix_nav" id="fix_nav">
    <div class="divider"></div>
    <div class="nav_bg">
        <div class="nav">
            <ul>
                <li class="home"><a href="index.php">首页</a></li>
                <li class="life"><a href="life.php">生活</a></li>
                <li class="skill"><a href="skill.php">技术</a></li>
                <li class="album"><a href="album.php" target="_blank">相册</a></li>
                <li class="video"><a href="video.php" target="_blank">视频</a></li>
                <li class="experience"><a href="experience.php" target="_blank">经验</a></li>
                <li class="about"><a href="about.php">关于本站</a></li>
            </ul>
        </div>
    </div>

    <div class="divider"></div>
</div>