<?php
/**
 * Created by PhpStorm.
 * User: JS
 * Date: 2017/6/6 0006
 * Time: 10:06
 */
function __autoload($classname)
{
    $classfile = 'actions/'.$classname . '.class.php';
    file_exists($classfile) ? include $classfile : die('类文件不存在！');
}

$model = isset($_GET['m']) ? $_GET['m'] : 'user';
$action = isset($_GET['a']) ? $_GET['a'] : 'index';
$id = isset($_GET['id']) ? $_GET['id'] :  null;
$key = isset($_GET['key']) ? $_GET['key'] : null;

$class = $model.'Action';
$m = new $class();
$m->$action($id, $key);