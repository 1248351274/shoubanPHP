<?php
namespace app\wshop\controller;
use think\Controller;
use think\Session;
use think\Db;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept,Authorization,loginID");
class Shop extends UserBase
{
    public function getshopmsg(){
        $id = $this->login_id;
        $msg = Db::table('shop')
                    ->where('U_Id',$id)
                    ->select();
        foreach ($msg as $key => $value) {
            $msg[$key]['goods'] = Db::table('shop_goods')
                                        ->join('goods','shop_goods.G_Id=Goods_Id')
                                        ->where('S_Id',$value['Shop_Id'])
                                        ->where('Goods_Flag','1')
                                        ->where('Goods_Status','1')
                                        ->select();
            foreach ($msg[$key]['goods'] as $keyy => $valuee) {
                $msg[$key]['goods'][$keyy]['img'] = Db::table('image')->where('G_Id',$valuee['Goods_Id'])->value('Image_Location');
            }
        }
        if($msg){
            return json_encode(array('result'=>'1','info'=>$msg));
        }else{
            return json_encode(array('result'=>'0','info'=>'您还没有注册店铺'));
        }
    }
    public function getaddgoo(){
        $id = $this->login_id;
        $sid = $_POST['sid'];
        $goo = Db::table('goods')
                    ->where('U_Id',$id)
                    ->where('Goods_Flag','0')
                    ->where('Goods_Status','1')
                    ->select();
        foreach($goo as $key => $value){
            $goo[$key]['img'] = Db::table('image')->where('G_Id',$value['Goods_Id'])->value('Image_Location');
        }
        if(count($goo)!=0){
            return json_encode(array('result'=>'1','info'=>$goo));
        }else{
            return json_encode(array('result'=>'0','info'=>'没有可以添加的商品'));
        }
    }
    //下架
    public function remove(){
        $gid = $_POST['gid'];
        $sid = $_POST['sid'];
        Db::startTrans();
        try{
            Db::table('shop_goods')->where('S_Id',$sid)->where('G_Id',$gid)->delete();
            Db::table('goods')->where('Goods_Id',$gid)->update(['Goods_Flag'=>'0']);
            return json_encode(array('result'=>1));
        }catch(\Exception $e){
            Db::rollback();
            return json_encode(array('result'=>0));
        }
    }
    //上架
    public function addshop(){
        $gid = $_POST['gid'];
        $sid = $_POST['sid'];
        $ins['S_Id'] = $_POST['sid'];
        $ins['G_Id'] = $_POST['gid'];
        Db::startTrans();
        try{
            Db::table('shop_goods')->insert($ins);
            Db::table('goods')->where('Goods_Id',$gid)->update(['Goods_Flag'=>'1']);
            return json_encode(array('result'=>1));
        }catch(\Exception $e){
            Db::rollback();
            return json_encode(array('result'=>0));
        }
    }
    //修改
    public function editshop(){
        $id = $_POST['sid'];
        $name = $_POST['sname'];
        if($id==0){
            $data['U_Id'] = $this->login_id;
            $data['Shop_Name'] = $_POST['sname'];
            Db::table('shop')->insert($data);
            $rs = Db::table('shop')->where($data)->select();
            if($rs){
                return json_encode(array('result'=>2,'info'=>'店铺创建成功'));
            }else{
                return json_encode(array('result'=>0,'info'=>'店铺创建失败'));
            }
        }else{
            Db::table('shop')->where('Shop_Id',$id)->update(['Shop_Name'=>$name]);
            $rs = Db::table('shop')->where('Shop_Id',$id)->where('Shop_Name',$name)->select();
            if($rs){
                return json_encode(array('result'=>1,'info'=>'修改成功'));
            }else{
                return json_encode(array('result'=>0,'info'=>'修改失败'));
            }
        }

    }

    public function createshop(){
        $id = $this->login_id;
        $data = $_POST;

    }

}
