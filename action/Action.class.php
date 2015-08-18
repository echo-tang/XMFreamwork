<?php
/**
 * 控制器基类
 */
class Action {

    protected $_tpl;
    protected $_model;

    protected function __construct(&$_tpl, &$model = null ) {
        $this->_tpl = $_tpl;
        $this->_model = $model;
    }

    //分页

}