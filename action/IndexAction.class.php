<?php
/**
 * 控制层示例
 */

class IndexAction extends Action {

    //构造方法初始化
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new IndexModel());
    }

    //主控制器
    public function  _action() {
        //传入对应的参数
        $this->_tpl->assign('title','Hello XMFreamworke');
    }

}