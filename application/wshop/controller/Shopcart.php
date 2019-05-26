<?php
namespace app\wshop\controller;
use think\Controller;
use think\Session;
use think\Db;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept,Authorization,loginID");
class Shopcart extends UserBase
{
    public function showcart()
    {
        $id = $this->login_id;
        $msg = Db::table('shopcart')
                    ->join('goods','shopcart.G_Id=Goods_Id','left')
                    //->join('image','shopcart.G_Id=image.G_Id','inner')
                    ->where('shopcart.U_Id',$id)
                    ->select();
        // foreach($msg as $key => $value){
        //     $msg[$key]['img']
        // }
        foreach ($msg as $key => $value) {
            $msg[$key]['Image_Location'] = Db::table('image')->where('G_Id',$value['G_Id'])->value('Image_Location');
        }
        if($msg){
            return json_encode(array('result'=>1,'info'=>$msg));
        }else{
            return json_encode(array('result'=>0,'info'=>'购物车为空'));
        }
    }
    public function editcart()
    {
        $id = $this->login_id;
        $data = $_POST;
        $data['U_Id'] = $id;
        $data['SC_CreatTime'] = time();
        $where['U_Id'] = $id;
        $where['G_Id'] = $data['G_Id'];
        $isexit = Db::table('shopcart')
                    ->where($where)
                    ->select();
        if($isexit){
            if($data['G_Num']==0){
                $rs = Db::table('shopcart')
                        ->where($where)
                        ->delete();
            }else{
                $rs = Db::table('shopcart')
                        ->where($where)
                        ->update($data);
            }
        }else{
            if($data['G_Num']!=0){
                $rs = Db::table('shopcart')
                    ->insert($data);
            }
        }
        if($rs){
            return json_encode(array('result'=>1));
        }else{
            return json_encode(array('result'=>0));
        }
    }
    public function delcart()
    {
        $data = $_POST['SC_Id'];
        $a = explode(',',$data);
        Db::startTrans();
        try{
            foreach($a as $key => $value){
                $rs = Db::table('shopcart')
                        ->where('SC_Id',$value)
                        ->delete();
            }
            return json_encode(array('result'=>1));
        }catch(\Exception $e){
            Db::rollback();
            return json_encode(array('result'=>0));
        }
    }
    public function getcarnum(){
        $where['U_Id'] = $this->login_id;
        $where['G_Id'] = $_POST['G_Id'];
        $num = Db::table('shopcart')
                ->where($where)
                ->value('G_Num');
        if($num){
            return json_encode(array('result'=>1,'info'=>$num));
        }else{
            return json_encode(array('result'=>0));
        }
    }
    public function order(){
        $id = $this->login_id;
        $data = $_POST;
        $a = explode(',',$data['SC_Id']);
        $order['U_Id'] = $id;
        $order['Order_Time'] = time();

        Db::startTrans();
        try{
            foreach($a as $key => $value){
                $b = Db::table('shopcart')->where('SC_Id',$value)->find();
                $c = Db::table('goods')->where('Goods_Id',$b['G_Id'])->value('Goods_Price');
                $d = Db::table('goods')->where('Goods_Id',$b['G_Id'])->value('U_Id');
                $order['G_Name'] = Db::table('goods')->where('Goods_Id',$b['G_Id'])->value('Goods_Name');
                $order['Order_Num'] = $b['G_Num'];
                $order['G_Id'] = $b['G_Id'];
                $order['Shop_Id'] = Db::table('shop_goods')->where('G_Id',$b['G_Id'])->value('S_Id');
                $order['Order_Price'] = $b['G_Num']*$c;
                Db::table('order')->insert($order);
                Db::table('user')->where('User_Id',$id)->setDec('User_Balance',$order['Order_Price']);
                Db::table('shopcart')->where('SC_Id',$value)->delete();
                Db::table('user')->where('User_Id',$d)->setInc('User_Balance',$order['Order_Price']);
            }
            return json_encode(array('result'=>1));
        }catch(\Exception $e){
            Db::rollback();
            return json_encode(array('result'=>0));
        }
    }
    public function getmsg(){
        $gid = $_POST['gid'];
        $sg = Db::table('shop_goods')->where('G_Id',$gid)->find();
        $shop = Db::table('shop')->where('Shop_Id',$sg['S_Id'])->find();
        $user = Db::table('user')->where('User_Id',$shop['U_Id'])->find();
        $eva = Db::table('evaluate')->where('S_Id',$shop['Shop_Id'])->select();
        $alleva = 0;
        if($eva){
            foreach($eva as $key => $value){
                $alleva += $value['Evaluate'];
            }
            $aveva = $alleva/count($eva);
        }else{
            $aveva = 0;
        }
        $msg['shop'] = $shop['Shop_Name'];
        $msg['eva'] = round(($aveva/5)*100)."%";
        $msg['user'] = $user;
        $m = array_merge($msg,$user);
        return json_encode(array('result'=>1,'info'=>$m));
    }
}
