<?php

namespace Addons\HeiHeiHei;
use Common\Controller\Addon;

/**
 * 嘿嘿嘿插件
 * @author Bestony
 */

    class HeiHeiHeiAddon extends Addon{

        public $info = array(
            'name'=>'HeiHeiHei',
            'title'=>'嘿嘿嘿',
            'description'=>'老司机开车啦',
            'status'=>1,
            'author'=>'Bestony',
            'version'=>'1.0',
            'has_adminlist'=>0,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/HeiHeiHei/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/HeiHeiHei/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }