<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/8 0008
 * Time: 14:17
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
    <title>Jorelanbo博客后台登录</title>
    <link rel="stylesheet" type="text/css" href="templates/style/base_admin.css">
    <link rel="stylesheet" href="include/kindeditor/themes/default/default.css" />
    <link rel="stylesheet" href="include/kindeditor/plugins/code/prettify.css" />
    <script charset="utf-8" src="include/kindeditor/kindeditor.js"></script>
    <script charset="utf-8" src="include/kindeditor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="include/kindeditor/plugins/code/prettify.js"></script>
    <script>
        KindEditor.ready(function(K) {
            var editor1 = K.create('textarea[name="article_content"]', {
                cssPath : 'include/kindeditor/plugins/code/prettify.css',
                uploadJson : 'include/upload/upload_json.php',
//                fileManagerJson : 'include/upload/file_manager_json.php',     //目前将文件上传到七牛云，所以不用在服务器添加文件管理文件
                allowFileManager : true,
                resizeType : 0,
                afterCreate : function() {
                    var self = this;
                    K.ctrl(document, 13, function() {
                        self.sync();
                        K('form[name=article]')[0].submit();
                    });
                    K.ctrl(self.edit.doc, 13, function() {
                        self.sync();
                        K('form[name=article]')[0].submit();
                    });
                },
                afterChange: function() {
                }
            });
            prettyPrint();
        });
    </script>
</head>
<body class="writeArticle_body">
    <form name="article" action="" method="post">
        <table cellspacing="15px">
            <tr>
                <td>文章标题：<input class="article_item" type="text" placeholder="title"></td>
            </tr>
            <tr>
                <td >文章类型：<select title="article_type" name="article_type">
                        <option value="skill">技术</option>
                        <option value="life">生活</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>关键词语：<input class="article_item" type="text" placeholder="keyword"></td>
            </tr>
            <tr>
                <td>文章内容：<textarea title="article_content" name="article_content" style="width:1200px;height:500px;visibility:hidden;resize: none"></textarea></td>
            </tr>
            <tr>
                <td>　　　　　　　　　　　　　　　　　　<input type="submit" value="提　　交" id="submit">　　　　<input type="reset" value="重　　置" id="reset"></td>
            </tr>
        </table>
    </form>

</body>
</html>
