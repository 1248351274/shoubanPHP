<?php
namespace app\index\controller;
use \think\Controller;
use \think\Db;
use \think\Session;
class Member extends Sesspar
{

    public function index()
    {	
        $data = array();

        if(isset($_GET['user']) && $_GET['user']!=''){
            $data['User_Name'] = array('like',"%".$_GET['user']."%");
            $this->assign('user',$_GET['user']);
        }
       
        $rs = Db::table('user')
                ->order('User_Id desc')
                ->where($data)
    			->paginate(10,false,['query'=>request()->param()]);
        $count = Db::table('user')
                ->where($data)
                ->count();
        $this->assign('count',$count);      
    	$this->assign('list',$rs);
		return $this->fetch();
    }
    public function user_off(){
        $id = $_POST['id'];

        Db::startTrans();
        try{
            Db::table('user')->where('User_Id',$id)->update(['User_Flag'=>'0']);
            Db::table('goods')->where('U_Id',$id)->update(['Goods_Flag'=>'0']);
            Db::commit();
            echo 1;
        }catch(\Exception $e){
            Db::rollback();
            echo 0;
        }
    }
    public function user_on(){
        $id = $_POST['id'];
        $rs = Db::table('user')->where('User_Id',$id)->update(['User_Flag'=>'1']);
        if($rs){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function delalluser(){
        $id = $_POST['id'];
        Db::startTrans();
        try{
            foreach ($id as $key => $value) {
                Db::table('user')->where('User_Id',$value)->update(['User_Flag'=>'0']);
                Db::table('goods')->where('U_Id',$value)->update(['Goods_Flag'=>'0']);
            }
            Db::commit();
            echo 1;
        }catch(\Exception $e){
            Db::rollback();
            echo 0;
        }
    }

}
