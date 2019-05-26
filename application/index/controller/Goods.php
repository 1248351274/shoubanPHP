<?php
namespace app\index\controller;
use \think\Controller;
use \think\Db;
use \think\Session;
class Goods extends Sesspar
{
    public function goodslist(){
        $data = array();
        $where = array();
        if(isset($_GET['good']) && $_GET['good']!=''){
            $data['Goods_Name'] = array('like',"%".$_GET['good']."%");
            $this->assign('good',$_GET['good']);
        }
        if(isset($_GET['user']) && $_GET['user']!=''){
            $where['User_Name'] = array('like',"%".$_GET['user']."%");
            $this->assign('user',$_GET['user']);
        }
        $rs = Db::table('goods')
                ->join('goodstype','goods.GT_Id=goodstype.GT_Id')
                ->join('user','goods.U_Id=user.User_Id')
               // ->join('image','goods.Goods_Id=image.G_Id','left')
                ->order('Goods_Id desc')
                ->where('Goods_Status',1)
                ->where($data)
                ->where($where)
                ->paginate(10,false,['query'=>request()->param()]);
        $count = Db::table('goods')->order('Goods_Id desc')->where('Goods_Status',1)->where($where)->where($data)->count();
        $this->assign('count',$count);      
    	$this->assign('list',$rs);
		return $this->fetch();
    }
    public function shlist(){
        $data = array();
        $where = array();
        if(isset($_GET['good']) && $_GET['good']!=''){
            $data['Goods_Name'] = array('like',"%".$_GET['good']."%");
            $this->assign('good',$_GET['good']);
        }
        if(isset($_GET['user']) && $_GET['user']!=''){
            $where['User_Name'] = array('like',"%".$_GET['user']."%");
            $this->assign('user',$_GET['user']);
        }
        $rs = Db::table('goods')
                ->join('goodstype','goods.GT_Id=goodstype.GT_Id')
                ->join('user','goods.U_Id=user.User_Id')
               // ->join('image','goods.Goods_Id=image.G_Id','left')
                ->order('Goods_Id desc')
                ->where('Goods_Status',0)
                ->where($data)
                ->where($where)
                ->paginate(10,false,['query'=>request()->param()]);
                
        $count = Db::table('goods')->order('Goods_Id desc')->where('Goods_Status',0)->where($data)->where($where)->count();
        $this->assign('count',$count);      
    	$this->assign('list',$rs);
		return $this->fetch();
    }
    public function delallgoo(){
        $id = $_POST['id'];
        Db::startTrans();
        try{
            foreach ($id as $key => $value) {
                $img = Db::table('image')->where('G_Id',$value)->select();
                Db::table('goods')->where('Goods_Id',$value)->delete();
                Db::table('shop_goods')->where('G_Id',$value)->delete();
                foreach($img as $keyy => $valuee){
                    Db::table('image')->where('Image_Id',$valuee['Image_Id']);
                    unlink(substr($valuee['Image_Location'],8));
                }
            }
            Db::commit();
            echo 1;
        }catch(\Exception $e){
            Db::rollback();
            echo 0;
        }
    }
    public function goodel(){
        $id = $_POST['id'];
        Db::startTrans();
        try{
            $img = Db::table('image')->where('G_Id',$id)->select();
            Db::table('goods')->where('Goods_Id',$id)->delete();
            Db::table('shop_goods')->where('G_Id',$id)->delete();
            foreach($img as $key => $value){
                Db::table('image')->where('Image_Id',$value['Image_Id']);
                unlink(substr($value['Image_Location'],8));
            }
            Db::commit();
            echo 1;
        }catch(\Exception $e){
            Db::rollback();
            echo 0;
        }
    }
    public function tg(){
        $id = $_POST['id'];
        $rs = Db::table('goods')->where('Goods_Id',$id)->update(['Goods_Status'=>'1']);
        if($rs){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function btg(){
        $id = $_POST['id'];
        $rs = Db::table('goods')->where('Goods_Id',$id)->update(['Goods_Status'=>'2']);
        if($rs){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function shall(){
        $id = $_POST['id'];
        Db::startTrans();
        try{
            foreach ($id as $key => $value) {
                Db::table('goods')->where('Goods_Id',$value)->update(['Goods_Status'=>'1']);
            }
            Db::commit();
            echo 1;
        }catch(\Exception $e){
            Db::rollback();
            echo 0;
        }
    }
}
