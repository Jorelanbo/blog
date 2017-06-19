<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/5/24 0024
 * Time: 12:22
 */

/*路径定义*/
define('INCLUDE_PATH',__DIR__.'/../include/');
define('TEMPLATES_PATH',__DIR__.'/../templates/');

/*引入文章*/
require_once INCLUDE_PATH . 'mysqli.class.php';
require_once "common.func.php";

define('LIFE_ARTICLE_TYPE', 2);
define('SKILL_ARTICLE_TYPE', 1);