<?php
namespace app\index\controller;
use \think\Controller;
use \think\Db;
use \think\Session;
class Index extends Controller
{
    public function index()
    {
		return $this->fetch();
    }
    public function login(){
    	$data = $_POST;
        $where['Admin_Name'] = $data['username'];
        $where['Admin_Password'] = md5($data['password']);
    	$rs = Db::table('admin')->where($where)->find();
    	if($rs && $rs['Admin_Flag']==1){
            session::set('username',$data['username']);
            session::set('password',$data['password']);
            session::set('power',$rs['Admin_Power']);
            Db::table('admin')->where($where)->update(['Admin_LastTime'=>time()]);
    		echo 1;
    	}else{
    		echo 0;
    	}
    }
    public function login_out(){
        session(null);
        $this->redirect('index/index/index');
    }
}
