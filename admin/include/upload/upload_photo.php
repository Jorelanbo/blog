<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/7/3 0003
 * Time: 15:47
 */

/**
 * @param $v
 * @return bool
 *
 * 过滤掉空的数据
 */
/*function delEmpty($v)
{
    return $v != "";
}

$fileName = @array_filter($_FILES['file']['name'], 'delEmpty');

//echo "<pre>";
//print_r($fileName);
//print_r($_FILES);

//配置上传目录
$dirName = 'tmp/';
if (!file_exists($dirName)) {
    mkdir($dirName);
}
//多文件上传处理
foreach ($fileName as $k => $v) {
    $newFilePath = $dirName . '/' . mt_rand(10, 1000) . $v;
    if (is_uploaded_file($_FILES['file']['tmp_name'][$k])) {
        if (!move_uploaded_file($_FILES['file']['tmp_name'][$k], $newFilePath)) {
            echo "<script></script>alert('上传文件失败！');</script>";
            exit;
        }
        $fileSize = number_format($_FILES['file']['size'][$k] / 1024, 1);
    } else {
        echo "<script>alert('非法文件！')</script>";
    }
}*/

echo "<pre>";
print_r($_FILES);
echo '<br>';
echo $_FILES['file']['tmp_name'];
if (!empty($_FILES['file']['name'])) {
    if ($_FILES['file']['error'] > 0) {
        $errorMsg = "";
        switch ($_FILES['file']['error']) {
            case 1:
                $errorMsg = "上传的文件超过了php.ini所规定的大小";
                break;
            case 2:
                $errorMsg = "上传的文件超过了前台表单规定的大小";
                break;
            case 3:
                $errorMsg = "文件上传不完整";
                break;
            case 4:
                $errorMsg = "没有上传文件";
                break;
        }
        echo "发生错误 ：{$errorMsg}";
        exit;
    } else {
        //对上传类型进行判断
        $types = ['.jpg', '.png', 'bmp', '.gif'];
        $uploadFileType = strtolower(strrchr($_FILES['file']['name'], "."));
        if (!in_array($uploadFileType, $types)) {
            echo "<script>alert('上传类型不合法，请选择图片类型上传！');history.go(-1);</script>";
            exit;
        }

        //处理上传文件
        $dirname = 'attached/';
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $toFileName = $dirname.'/'.time().'_'.mt_rand(10, 300).$_FILES['file']['name'];
            if (move_uploaded_file($_FILES['file']['tmp_name'], $toFileName)) {
                echo "<script>alert('上传成功！')</script>";
            } else {
                echo "<script>alert('错误！上传失败')</script>";
            }
        } else {
            echo "<script>alert('错误！不是上传文件')</script>";
        }
    }
} else {
    echo "<script>alert('请选择上传文件');history.go(-1);</script>";
}