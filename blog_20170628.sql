-- MySQL dump 10.13  Distrib 5.5.53, for Win32 (AMD64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	5.5.53

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(30) NOT NULL,
  `QQ` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (7,'js','6f6220d2abf3111e83f2bb49e16ff05a','1062976570@qq.com',1062976570);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `introduction` varchar(100) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `create_time` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
/*!40000 ALTER TABLE `album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `article_type_id` int(5) NOT NULL,
  `keywords` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `view_times` int(10) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `introduction` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'第一篇文章',1,'第一','我oioi',2,1497493846,'写的第一篇文章'),(2,'糊涂神',2,'糊涂','难得糊涂',2,1497496727,'关于糊涂'),(3,'大大世界',2,'大','大世界',0,1497497102,'关于世界'),(4,'My World',2,'world','<p>\r\n	<span style=\"font-size:18px;\"><br />\r\n</span> \r\n</p>\r\n<p>\r\n	<span style=\"font-size:18px;\"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;about world</span><span style=\"font-size:18px;\">about world</span><span style=\"font-size:18px;\">about world</span><span style=\"font-size:18px;\">about world</span><span style=\"font-size:18px;\">about world</span> \r\n</p>',3,1497497822,'about world'),(5,'第四篇文章',2,'第四','<p>\r\n	<span style=\"color:#337FE5;font-size:16px;\"><br />\r\n</span>\r\n</p>\r\n<p>\r\n	<span style=\"color:#337FE5;font-size:16px;\"><br />\r\n</span>\r\n</p>\r\n<p>\r\n	<span style=\"color:#337FE5;font-size:16px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;第四的一篇文章</span>\r\n</p>',1,1497498079,'第四的文章'),(6,'五',1,'五','五',0,1497498715,'五'),(7,'六',1,'六','六',0,1497498732,'六'),(8,'七',1,'七','七啊七',0,1497498744,'七'),(9,'八',1,'八','八',0,1497498756,'八'),(10,'九',1,'九','九',0,1497498768,'九'),(11,'十',2,'十','十',2,1497498780,'十'),(12,'第十四',1,'十四','苏菲的世界',0,1497517014,'blablabla'),(13,'乱乱的',1,'wonder','啥都乱乱的',0,1497517648,'没有'),(14,'二十一',1,'四','二十一',0,1497520304,'二十一'),(15,'二十二',1,'四','二十二',0,1497520328,'二十二'),(16,'二十三',1,'四','二十三',1,1497520360,'二十三'),(17,'二十四',1,'四','二十四',0,1497520372,'二十四'),(18,'二十五',1,'四','二十五',0,1497520384,'二十五'),(19,'二十六',1,'四','二十六',0,1497520398,'二十六'),(20,'二十七',1,'四','二十七',0,1497520412,'二十七'),(21,'二十八',1,'四','二十八',3,1497520429,'二十八'),(22,'二十九',1,'四','二十九',2,1497520444,'二十九'),(23,'三十',1,'四','三十',2,1497520458,'三十'),(25,'PHP提交表单失败后如何保留已经填写的信息呀呀呀呀呀哎呀呀呀呀呀呀哎呀呀呀呀呀呀呀哎呀呀',1,'important','<span> \r\n<div>\r\n	<p>\r\n		<span style=\"font-size:16px;\">本文介绍PHP提交表单失败后如何保留填写的信息一些方法总结，其中最常用的就是使用缓存方式了，这种方法如果网速慢是可能出问题的，最好的办法就是使用ajax了。</span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:16px;\"><strong>1．使用header头设置缓存控制头Cache-control。</strong></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:16px;\">PHP代码如下：</span>\r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:16px;\">\r\n<pre class=\"prettyprint lang-php\">header(\'Cache-control: private, must-revalidate\');//支持页面回跳</pre>\r\n</span> \r\n	</p>\r\n	<div>\r\n	</div>\r\n	<p>\r\n		<span style=\"font-size:16px;\"><strong>2．使用session_cache_limiter方法。</strong></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:16px;\">PHP代码如下：</span>\r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:16px;\">\r\n<pre class=\"prettyprint lang-php\">session_cache_limiter(\'private, must-revalidate\');//要写在session_start方法之前</pre>\r\n</span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:16px;\">下面介绍一下session_cache_limiter参数：</span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:16px;\">session_cache_limiter内的几个参数意义是：<br />\r\nnocache：当然是不缓存（比如：表单信息被清除），但公共变量可以缓存<br />\r\nprivate：私有方式缓存（比如：表单信息被保留，但在生存期内有效）<br />\r\nprivate_no_cache：私有方式但不过期（表单信息被保留）<br />\r\npublice：公有方式，（表单信息也被保留）<br />\r\n设置缓存过期时间：session_cache_expire函数设置，缺省是180分钟。</span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:16px;\"><strong>常遇见问题：</strong></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:16px;\">1.session_cache_limiter(\"private\");表单信息是保留了,但是如果我修改已经提交的信息,表单页面所呈现的信息 还是缓存里信息,没能及时自动刷新,如果不用session_cache_limiter(\"private\");又不能保留表单信息<br />\r\n解决方案：</span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:16px;\">在session_start前面加上</span> \r\n	</p>\r\n	<div>\r\n		<div>\r\n			<span style=\"font-size:16px;\">\r\n<pre class=\"prettyprint lang-php\">session_cache_limiter(\"private, must-revalidate\");</pre>\r\n</span> \r\n		</div>\r\n	</div>\r\n	<p>\r\n		<span style=\"font-size:16px;\">即可。</span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:16px;\"><strong>2.另一种办法我们可以使用ajax来实例</strong></span> \r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:16px;\">index.html模板文件大致内容如下：</span> \r\n	</p>\r\n	<div>\r\n		<div>\r\n			<span style=\"font-size:16px;\">\r\n<pre class=\"prettyprint lang-js\">jQuery Ajax 实例演示\r\n=\" data-ke-src=\".&gt;&lt;/span&gt; &lt;/div&gt;&lt;div&gt;&lt;span&gt;=\"\" &lt;=\"\" div&gt;\r\n$(document).ready(function(){//这个就是jQueryready ，它就像C语言的main 所有操作包含在它里面\r\n$(\"#button_login\").mousedown(function(){\r\nlogin(); //点击ID为\"button_login\"的按钮后触发函数 login();\r\n});\r\nfunction login(){ //函数 login();\r\nvar username = $(\"#username\").val();//取框中的用户名\r\nvar password = $(\"#password\").val();//取框中的密码\r\n$.ajax({ //一个Ajax过程\r\ntype: \"post\", //以post方式与后台沟通\r\nurl : \"login.php\", //与此php页面沟通\r\ndataType:\'json\',//从php返回的值以 JSON方式 解释\r\ndata: \'username=\'+username+\'&amp;password=\'+password, //发给php的数据有两项，分别是上面传来的u和p\r\nsuccess: function(json){//如果调用php成功\r\n//alert(json.username+\'n\'+json.password); //把php中的返回值（json.username）给 alert出来\r\n$(\'#result\').html(\"姓名:\" + json.username + \"\r\n密码:\" + json.password); //把php中的返回值显示在预定义的result定位符位置\r\n}\r\n});\r\n}\r\n//$.post()方式：\r\n$(\'#test_post\').mousedown(function (){\r\n$.post(\r\n\'login.php\',\r\n{\r\nusername:$(\'#username\').val(),\r\npassword:$(\'#password\').val()\r\n},\r\nfunction (data) //回传函数\r\n{\r\nvar myjson=\'\';\r\neval_r(\'myjson=\' + data + \';\');\r\n$(\'#result\').html(\"姓名1:\" + myjson.username + \"\r\n密码1:\" + myjson.password);\r\n}\r\n);\r\n});\r\n//$.get()方式：\r\n$(\'#test_get\').mousedown(function (){\r\n$.get(\r\n\'login.php\',\r\n{\r\nusername:$(\'#username\').val(),\r\npassword:$(\'#password\').val()\r\n},\r\nfunction(data) //回传函数\r\n{\r\nvar myjson=\'\';\r\neval_r(\"myjson=\" + data + \";\");\r\n$(\'#result\').html(\"姓名2:\" + myjson.username + \"\r\n密码2:\" + myjson.password);\r\n}\r\n);\r\n});\r\n});\r\n\r\n输入姓名:\r\n\r\n输入密码:\r\najax提交\r\npost提交\r\nget提交 </pre>\r\n</span> \r\n		</div>\r\n	</div>\r\n	<p>\r\n		<span style=\"font-size:16px;\">login.php文件的内容如下：</span>\r\n	</p>\r\n	<p>\r\n		<span style=\"font-size:16px;\">\r\n<pre class=\"prettyprint lang-php\">1\r\n2\r\n3 </pre>\r\n</span> \r\n	</p>\r\n	<div>\r\n	</div>\r\n</div>\r\n</span>',39,1497601857,'表单提交失败后的保留数据操作'),(28,'试一试有图片的文章',2,'有图片，important','<p>\r\n	这是一篇关于，秋酱的文章，里面有图片\r\n</p>\r\n<p>\r\n	<img src=\"http://or9amuuk2.bkt.clouddn.com/20170619150401_81218.jpg\" alt=\"\" />\r\n</p>',10,1497855845,'图片文章'),(29,'图片还可以上传七牛了吗',1,'上传到七牛','<p>\r\n	传着一张图片试试\r\n</p>\r\n<p>\r\n	<img src=\"http://or9amuuk2.bkt.clouddn.com/20170622131321_67947.jpg\" alt=\"\" />\r\n</p>',5,1498108417,'看能不能上传到七牛important'),(26,'超过登录状态时间后登录页面出现在iframe中的问题超过登录状态时间后登录页面出现在iframe中的',1,'important','<span>\r\n<div>\r\n	<span><b><span style=\"font-size:12pt;\"><span style=\"font-family:Consolas;\"><span style=\"color:#000080;\"><br />\r\n</span></span></span></b></span>\r\n</div>\r\n<div>\r\n	<b><span style=\"font-size:12pt;\"><span style=\"font-family:Consolas;\"><span style=\"color:#000080;\">只要在登录页面加入以下js代码即可，让本页面在最高location</span></span></span></b>\r\n</div>\r\n<div>\r\n	<b><span style=\"font-size:12pt;\"><span style=\"font-family:Consolas;\"><span style=\"color:#000080;\"><br />\r\n</span></span></span></b>\r\n</div>\r\n<div>\r\n	<span style=\"font-size:12pt;\"><span style=\"font-family:Consolas;\"><span style=\"color:#000080;font-weight:bold;\">if</span>(<span style=\"color:#660e7a;font-weight:bold;\">top</span>.<span style=\"color:#660e7a;font-weight:bold;\">location</span>!==<span style=\"color:#660e7a;font-weight:bold;\">self</span>.<span style=\"color:#660e7a;font-weight:bold;\">location</span>)</span></span>\r\n</div>\r\n<div style=\"background-color:#ffffff;color:#000000;font-family:\'Consolas\';font-size:12.0pt;\">\r\n	{<br />\r\n&nbsp; &nbsp; <span style=\"color:#660e7a;font-weight:bold;\">top</span>.<span style=\"color:#660e7a;font-weight:bold;\">location</span>=<span style=\"color:#660e7a;font-weight:bold;\">self</span>.<span style=\"color:#660e7a;font-weight:bold;\">location</span>;<br />\r\n}\r\n</div>\r\n</span>',45,1497605035,'超过登录状态时间后登录页面出现在iframe中的问题'),(27,'试一试有代码的文章',1,'有代码的，文章，important','<p>\r\n	试一试这个文章\r\n</p>\r\n<p>\r\n<pre class=\"prettyprint lang-html\">&lt;!DOCTYPE html&gt;\r\n&lt;html lang=\"en\"&gt;\r\n&lt;head&gt;\r\n    &lt;meta charset=\"UTF-8\"&gt;\r\n    &lt;meta http-equiv=\"refresh\" content=\"0;url=index.php\"&gt;\r\n    &lt;title&gt;Title&lt;/title&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;script&gt;\r\n//    window.location.href = \'index.php\';\r\n&lt;/script&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;</pre>\r\n</p>',93,1497845645,'代码in文章');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_type`
--

DROP TABLE IF EXISTS `article_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_type` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_type`
--

LOCK TABLES `article_type` WRITE;
/*!40000 ALTER TABLE `article_type` DISABLE KEYS */;
INSERT INTO `article_type` VALUES (1,'life'),(2,'skill');
/*!40000 ALTER TABLE `article_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links`
--

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
INSERT INTO `links` VALUES (2,'爱威尔','http://www.loveweir.com/'),(3,'PHP手册','http://php.net/manual/zh/index.php'),(4,'W3School','http://www.w3school.com.cn/'),(5,'jQuery','http://jquery.cuishifeng.cn/'),(6,'kindeditor','http://kindeditor.net/'),(7,'七牛云','https://www.qiniu.com/'),(8,'CSDN','http://www.csdn.net/'),(9,'网易云课堂','http://study.163.com/'),(10,'慕课网','http://www.imooc.com/'),(1,'放水的星星','http://fsdstar.com/');
/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `album_id` int(5) NOT NULL,
  `url` varchar(100) NOT NULL,
  `create_time` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo`
--

LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `sex` smallint(1) NOT NULL,
  `signature` varchar(60) DEFAULT NULL,
  `avatar_path` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Jorelanbo',1,'Haircut really matters!!!','http://or9amuuk2.bkt.clouddn.com/20170622182615_34620.jpg');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-28 19:27:48
