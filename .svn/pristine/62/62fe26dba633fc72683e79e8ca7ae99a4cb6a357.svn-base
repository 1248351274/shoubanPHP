<?php
namespace app\index\controller;
use \think\Controller;
use \think\Db;
use \think\Session;
class Admin extends Sesspar
{
    public function index()
    {	
        $data = array();

        if(isset($_GET['admin']) && $_GET['admin']!=''){
            $data['Admin_Name'] = array('like',"%".$_GET['admin']."%");
            $this->assign('admin',$_GET['admin']);
        }
    	$rs = Db::table('admin')
                ->where('Admin_Power',2)
                ->where($data)
    			->paginate(10,false,['query'=>request()->param()]);
        $count = Db::table('admin')
                ->where('Admin_Power',2)
                ->where($data)
                ->count();
    	$this->assign('count',$count);
    	$this->assign('list',$rs);
		return $this->fetch();
    }
    public function add_show(){
        return $this->fetch();
    }
    public function add(){
        $data = $_POST;
        $data['Admin_Password'] = md5($data['Admin_Password']);
        $data['Admin_Power'] = 2;
        $data['Admin_LastTime'] = time();
        $rs = Db::table('admin')->insert($data);
        if($rs){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function admin_on(){
        $id = $_POST['id'];
        $rs = Db::table('admin')->where('Admin_Id',$id)->update(['Admin_Flag'=>'1']);
        if($rs){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function admin_off(){
        $id = $_POST['id'];
        $rs = Db::table('admin')->where('Admin_Id',$id)->update(['Admin_Flag'=>'0']);
        if($rs){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function edit_show($id){
        $rs = Db::table('admin')
                ->where('Admin_Id',$id)
                ->find();
        $this->assign('msg',$rs);
        return $this->fetch();

    }
    public function edit(){
        $data = $_POST;
        if($data['Admin_Password']==''){
            unset($data['Admin_Password']);
        }else{
            $data['Admin_Password'] = md5($data['Admin_Password']);
        }
        Db::table('admin')->where('Admin_Id',$data['Admin_Id'])->update($data);
        $rs = Db::table('admin')->where($data)->find();
        if($rs){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function admin_del(){
        $id = $_POST['id'];
        $rs = Db::table('admin')->where('Admin_Id',$id)->delete();
        if($rs){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function delalladmin(){
        $id = $_POST['id'];
        Db::startTrans();
        try{
            foreach ($id as $key => $value) {
                Db::table('admin')->where('Admin_Id',$value)->delete();
            }
            Db::commit();
            echo 1;
        }catch(\Exception $e){
            Db::rollback();
            echo 0;
        }
    }
}
