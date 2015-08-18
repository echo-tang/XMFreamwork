<?php
/**
 * 首页
 */
require dirname(__FILE__).'/init.inc.php';

global $_tpl;

//Example
$index = new IndexAction($_tpl);
$index -> _action();

//Templates
$_tpl->display('index.tpl');