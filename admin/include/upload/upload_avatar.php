<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/22 0022
 * Time: 12:10
 */
require_once 'JSON.php';
require '../Qiniu_sdk/autoload.php';

// 引入鉴权类
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;

if (!isset($_COOKIE['login']) || $_COOKIE['login'] != 1) {
    echo 'access forbidden!';
    exit;
}
// 需要填写你的 Access Key 和 Secret Key
$accessKey = 'GGFZj7Nc-75_L9oXb4ucVSRCUvT-a_Kppu-qzrOu';
$secretKey = 'MKqQUmBnDhwGcXvjPQ0Nm7EczlofD7dCMWuQWLpM';

//文件保存目录路径
$save_path = './attached/';
////文件保存目录URL
//$save_url = './attached/';
//定义允许上传的文件扩展名
$ext_arr = array(
    'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
    'flash' => array('swf', 'flv'),
    'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
    'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
);
//最大文件大小
$max_size = 1000000;

$save_path = realpath($save_path) . '/';

$avatar = '';

//PHP上传失败
if (!empty($_FILES['imgFile']['error'])) {
    switch($_FILES['imgFile']['error']){
        case '1':
            $error = '超过php.ini允许的大小。';
            break;
        case '2':
            $error = '超过表单允许的大小。';
            break;
        case '3':
            $error = '图片只有部分被上传。';
            break;
        case '4':
            $error = '请选择图片。';
            break;
        case '6':
            $error = '找不到临时目录。';
            break;
        case '7':
            $error = '写文件到硬盘出错。';
            break;
        case '8':
            $error = 'File upload stopped by extension。';
            break;
        case '999':
        default:
            $error = '未知错误。';
    }
    alert($error);
}

//有上传文件时
if (empty($_FILES) === false) {
    //原文件名
    $file_name = $_FILES['imgFile']['name'];
    //服务器上临时文件名
    $tmp_name = $_FILES['imgFile']['tmp_name'];
    //文件大小
    $file_size = $_FILES['imgFile']['size'];
    //检查文件名
    if (!$file_name) {
        alert("请选择文件。");
    }
    //检查目录
    if (@is_dir($save_path) === false) {
        alert("上传目录不存在。");
    }
    //检查目录写权限
    if (@is_writable($save_path) === false) {
        alert("上传目录没有写权限。");
    }
    //检查是否已上传
    if (@is_uploaded_file($tmp_name) === false) {
        alert("上传失败。");
    }
    //检查文件大小
    if ($file_size > $max_size) {
        alert("上传文件大小超过限制。");
    }
    //检查目录名
    $dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
    if (empty($ext_arr[$dir_name])) {
        alert("目录名不正确。");
    }
    //获得文件扩展名
    $temp_arr = explode(".", $file_name);
    $file_ext = array_pop($temp_arr);
    $file_ext = trim($file_ext);
    $file_ext = strtolower($file_ext);
    //检查扩展名
    if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
        alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
    }
    //新文件名
    $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
    //移动文件
    $file_path = $save_path . $new_file_name;
    if (move_uploaded_file($tmp_name, $file_path) === false) {
        alert("上传文件失败。");
    }

    // 构建鉴权对象
    $auth = new Auth($accessKey, $secretKey);
    // 要上传的空间
    $bucket = 'jorelanbodotcom';
    // 生成上传 Token
    $token = $auth->uploadToken($bucket);

    // 初始化 UploadManager 对象并进行文件的上传
    $uploadMgr = new UploadManager();
    // 调用 UploadManager 的 putFile 方法进行文件的上传
    list($ret, $err) = $uploadMgr->putFile($token, $new_file_name, $file_path);

    @chmod($file_path, 0644);

    //文件的七牛云存储地址
    $file_url = 'http://or9amuuk2.bkt.clouddn.com/' . $new_file_name;

    $avatar = $file_url;
    unlink($file_path);
    setcookie('new_avatar', $avatar, 0, '/johnrainbow.com/admin/');
}

function alert($msg) {
    header('Content-type: text/html; charset=UTF-8');
    $json = new Services_JSON();
    echo $json->encode(array('error' => 1, 'message' => $msg));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jorelanbo博客后台</title>
    <link rel="stylesheet" type="text/css" href="templates/style/upload.css">
</head>
<body class="avatar_body">
<div class="update_avatar_box">
    <img class="update_avatar" src="<?php echo $avatar; ?>">
    <div class="blank"></div>
    <a id="submit" href="../../index.php?m=admin&a=master_p&id=2">确认</a>
</div>
</body>
</html>