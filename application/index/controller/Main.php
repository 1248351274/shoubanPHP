<?php
namespace app\index\controller;
use \think\Controller;
use \think\Db;
use \think\Session;
class Main extends Sesspar
{
    public function index()
    {
		return $this->fetch();
    }
    public function edit_show(){
    	return $this->fetch();
    }
    public function edit(){
    	$data = $_POST;
    	$rs = Db::table('admin')->where('Admin_Name',session::get('username'))->update(['Admin_Password'=>md5($data['newpwd'])]);
    	if($rs){
    		session::set('password',$data['newpwd']);
    		echo 1;
    	}else{
    		echo 0;
    	}
    }
}
