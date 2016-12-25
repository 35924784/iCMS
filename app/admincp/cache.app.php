<?php
/**
* iCMS - i Content Management System
* Copyright (c) 2007-2012 idreamsoft.com iiimon Inc. All rights reserved.
*
* @author coolmoo <idreamsoft@qq.com>
* @site http://www.idreamsoft.com
* @licence http://www.idreamsoft.com/license.php
* @version 6.0.0
*/
class cacheApp{
    public $acp = array('admincp.config.app','prop.admincp','filter.admincp','keywords.admincp');
    public function __construct() {
        $this->do_app();
    }
    public function do_all(){
        foreach ($this->acp as $key => $acp) {
            $acp = iPHP::app($acp);
            $acp->cache();
        }
        $this->do_menu(false);
        $this->do_allcategory(false);
        $this->do_category(false);
        $this->do_pushcategory(false);
        $this->do_tagcategory(false);
        $this->do_tpl(false);
        iUI::success('全部缓存更新完成');
    }
    public function do_iCMS($dialog=true){
		if (in_array($_GET['acp'], $this->acp)) {
	    	$acp = iPHP::app($_GET['acp']);
	    	$acp->cache();
	    	$dialog && iUI::success('更新完成');
		}
    }
    public function do_menu($dialog=true){
    	admincp::$menu->cache();
    	$dialog && iUI::success('更新完成','js:1');
    }
    public function do_allcategory($dialog=true){
    	$category = iPHP::app('category.class');
    	$category->cache(true);
    	$dialog && iUI::success('更新完成');
    }
    public function do_category($dialog=true){
        $categoryApp = iPHP::app('category.admincp');
        $categoryApp->do_cache($dialog);
    }
    public function do_pushcategory($dialog=true){
        $categoryApp = iPHP::app('push.category.admincp');
        $categoryApp->do_cache($dialog);
    }
    public function do_tagcategory($dialog=true){
        $categoryApp = iPHP::app('tag.category.admincp');
        $categoryApp->do_cache($dialog);
    }
    public function do_tpl($dialog=true){
    	iPHP::clear_compiled_tpl();
    	$dialog && iUI::success('清理完成');
    }
    public function do_article_count($dialog=true){
        $app = iPHP::app('article.category.admincp');
    	$app->re_app_count();
    	$dialog && iUI::success('更新完成');
    }
    public function do_app($dialog=true){
        iPHP::app('apps.class','static');
        APPS::cache();
    }
}
