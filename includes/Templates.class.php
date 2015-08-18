<?php
/**
 * 模板引擎
 */

class Templates {

    private $_vars = array();   //接收多个变量
    private $_cache = null;     //缓存对象

    //创建一个构造方法，验证各个目录是否存在
    public function __construct($_cache = null) {
        if(!is_dir(TPL_DIR) || !is_dir(TPL_C_DIR) || !is_dir(CACHE)) {
            exit('ERROR：模板目录或编译目录或缓存目录不存在！请手工设置！');
        }

        $this->_cache = $_cache;
    }

    //assign()方法，用于注入变量
    public function assign($_var, $_value) {

        //$_var用于同步模板里的变量名 例如index.php是name 那么index.tpl就是{$name}
        //$_value值表示的是index.php里的$_name的值，就是 '李炎恢'

        if (isset($_var) && !empty($_var)) {
            //$this->_vars['name']
            $this->_vars[$_var] = $_value;
        } else {
            exit('ERROR：请设置模板变量');
        }

    }

    //display()方法，用于展示变量
    public function display($_file) {

        $_tpl = $this;  //给include进来的tpl传一个模板操作的对象
        $_tplFile = TPL_DIR.$_file;  //设置模板的路径

        //判断模板是否存在
        if (!file_exists($_tplFile)) {
            exit('ERROR：模板文件不存在！');
        }

        //是否加入参数
        if (!empty($_SERVER["QUERY_STRING"])) {
            $_file_query .= $_SERVER["QUERY_STRING"];
        }

        //编译文件
        $_parFile = TPL_C_DIR.md5($_file).$_file.'.php';

        //缓存文件
        $_cacheFile = CACHE.md5($_file).$_file.$_file_query.'.html';

        //当编译文件不存在，或者模板文件修改过，则生成编译文件
        if (!file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)) {
            //引入模板解析类
            require_once ROOT_PATH.'/includes/Parser.class.php';
            $_parser = new Parser($_tplFile);   //模板文件
            $_parser->compile($_parFile);  //编译文件
        }

        //载入编译文件
        include $_parFile;

        if (IS_CAHCE && !$this->_cache->noCache()) {

            //获取缓冲区内的数据，并且创建缓存文件
            file_put_contents($_cacheFile,ob_get_contents());

            //清除缓冲区(清除了编译文件加载的内容)
            ob_end_clean();

            //载入缓存文件
            include $_cacheFile;
        }

    }

    //cache()方法，跳转到缓存文件，不执行PHP了，不连接数据了
    public function cache($_file) {

        //设置模板的路径
        $_tplFile = TPL_DIR.$_file;

        //判断模板是否存在
        if (!file_exists($_tplFile)) {
            exit('ERROR：模板文件不存在！');
        }

        //是否加入参数
        if (!empty($_SERVER["QUERY_STRING"])) {
            $_file .= $_SERVER["QUERY_STRING"];
        }

        //编译文件
        $_parFile = TPL_C_DIR.md5($_file).$_file.'.php';

        //缓存文件
        $_cacheFile = CACHE.md5($_file).$_file.'.html';

        //当第二次运行相同文件的时候，直接载入缓存文件，避开编译
        if (IS_CAHCE) {

            //缓存文件和编译文件都要存在
            if (file_exists($_cacheFile) && file_exists($_parFile)) {

                //判断模板文件是否修改过，判断编译文件是否修改过
                if (filemtime($_parFile) >= filemtime($_tplFile) && filemtime($_cacheFile) >= filemtime($_parFile)) {

                    //载入缓存文件
                    include $_cacheFile;
                    exit();

                }

            }

        }

    }

    //创建create方法，用于header和footer这种模块模板解析使用，而不需要生成缓存文件
    public function create($_file) {

        //设置模板的路径
        $_tplFile = TPL_DIR.$_file;

        //判断模板是否存在
        if (!file_exists($_tplFile)) {
            exit('ERROR：模板文件不存在！');
        }

        //编译文件
        $_parFile = TPL_C_DIR.md5($_file).$_file.'.php';

        //当编译文件不存在，或者模板文件修改过，则生成编译文件
        if (!file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)) {

            //引入模板解析类
            require_once ROOT_PATH.'/includes/Parser.class.php';
            $_parser = new Parser($_tplFile);   //模板文件
            $_parser->compile($_parFile);  //编译文件

        }

        //载入编译文件
        include $_parFile;

    }

}