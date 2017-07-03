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
    <link rel="stylesheet" type="text/css" href="include/webuploader/webuploader.css">
    <script type="text/javascript" src="templates/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="include/webuploader/webuploader.js"></script>

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
<body class="photos_body">
<div class="photos_body_blank"></div>
<div class="photos_list">
    <div class="photos_body_blank">
<!--        <a class="add_photo" id="add_photo"></a>-->
        <!--dom结构部分-->
        <div id="uploader-box">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker" class="add_photo">选择图片</div>
        </div>
    </div>
    <div class="photos_body_blank_large"></div>
    <?php
    for ($i = 0; $i < count($photos); $i ++) {
        $photo = $photos[$i];
        $id = $photo['id'];
        $name = $photo['name'];
        $url = $photo['url'];
        ?>
        <div class="item_box">
            <div class="album_item">
                <a href="<?php echo $url; ?>"><img src="<?php echo $url;?>"></a>
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

    // 初始化Web Uploader
    var uploader = WebUploader.create({

        // 选完文件后，是否自动上传。
        auto: true,

        // swf文件路径
        swf: 'include/webuploader/Uploader.swf',

        // 文件接收服务端。
        server: 'include/upload/upload_photo.php',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',

        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }
    });

    // 当有文件添加进来的时候
    var $list = $("#fileList");
    uploader.on( 'fileQueued', function( file ) {
        var $li = $(
                '<div id="' + file.id + '" class="file-item thumbnail">' +
                '<img>' +
//                '<div class="info">' + file.name + '</div>' +
                '</div>'
            ),
            $img = $li.find('img');


        // $list为容器jQuery实例
        $list.append( $li );

        // 创建缩略图
        // 如果为非图片文件，可以不用调用此方法。
        // thumbnailWidth x thumbnailHeight 为 100 x 100
        uploader.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }

            $img.attr( 'src', src );
        }, 100, 100 );
    });


    // 文件上传过程中创建进度条实时显示。
//    uploader.on( 'uploadProgress', function( file, percentage ) {
//        var $li = $( '#'+file.id ),
//            $percent = $li.find('.progress span');
//
//        // 避免重复创建
//        if ( !$percent.length ) {
//            $percent = $('<p class="progress"><span></span></p>')
//                .appendTo( $li )
//                .find('span');
//        }
//
//        $percent.css( 'width', percentage * 100 + '%' );
//    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file ) {
        $( '#'+file.id ).addClass('upload-state-done');
    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file ) {
        var $li = $( '#'+file.id ),
            $error = $li.find('div.error');

        // 避免重复创建
        if ( !$error.length ) {
            $error = $('<div class="error"></div>').appendTo( $li );
        }

        $error.text('上传失败');
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').remove();
    });


</script>
</body>
</html>

