<?php
namespace app\wshop\controller;
use think\Controller;
use think\Session;
use think\Db;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept,Authorization,loginID");
class Goods extends UserBase
{

    public function getgoods(){
        $id = $this->login_id;
        $msg = Db::table('goods')
                    ->where('U_Id',$id)
                    ->order('Goods_Id desc')
                    ->select();
        foreach($msg as $key => $value){
            $msg[$key]['img']=Db::table('image')
                                ->where('G_Id',$value['Goods_Id'])
                                ->select();
        }
        if($msg){
            return json_encode(array('result'=>'1','count'=>count($msg),'info'=>$msg));
        }else{
            return json_encode(array('result'=>'0','info'=>'暂无商品'));
        }
    }
    public function getgoodsmsg(){
        $id = $_POST['Goods_Id'];
        $msg = Db::table('goods')
                    ->join('goodstype','goods.GT_Id=goodstype.GT_Id')
                    ->where('Goods_Id',$id)
                    ->find();

        $msg['img']=Db::table('image')
                            ->where('G_Id',$msg['Goods_Id'])
                            ->select();

        if($msg){
            return json_encode(array('result'=>'1','info'=>$msg));
        }else{
            return json_encode(array('result'=>'0','info'=>'无此商品信息'));
        }
    }
    public function editgoods(){
        $data = $_POST;
        $data['GT_Id'] = Db::table('goodstype')->where('GT_Type',$data['Goods_Type'])->value('GT_Id');
        unset($data['Goods_Type']);
        Db::table('goods')->where('Goods_Id',$data['Goods_Id'])->update($data);
        $rs = Db::table('goods')->where($data)->select();
        if($rs){
            return json_encode(array('result'=>'1','info'=>'修改成功'));
        }else{
            return json_encode(array('result'=>'0','info'=>'修改失败'));
        }
    }
    public function delgood(){
        $id = $_POST['Goods_Id'];
        $msg = Db::table('goods')->where('Goods_Id',$id)->find();
        $shopcart = Db::table('shopcart')->where('G_Id',$id)->select();
        $img = Db::table('image')->where('G_Id',$id)->select();
        Db::startTrans();
        try{
            if($msg['Goods_Flag']==1){
                Db::table('shop_goods')->where('G_Id',$id)->delete();
            }
            if($shopcart){
                Db::table('shopcart')->where('G_Id',$id)->delete();
            }
            Db::table('goods')->where('Goods_Id',$id)->delete();
            Db::table('image')->where('G_Id',$id)->delete();
            if($img){
                foreach($img as $key => $value){
                    unlink(substr($value['Image_Location'],8));
                }
            }
            Db::commit();
            return json_encode(array('result'=>1));
        }catch(\Exception $e){
            Db::rollback();
            return json_encode(array('result'=>0));
        }
    }
    public function addgood(){
        $data = $_POST;  
        echo '$data';
        print_r($data);
        $data['U_Id'] = $this->login_id;
        $data['GT_Id'] = Db::table('goodstype')->where('GT_Type',$data['Goods_Type'])->value('GT_Id');
        if(isset($data['Goods_Imgid'])){
            $imgid = $data['Goods_Imgid'];
        }
        unset($data['Goods_Type']);// 销毁
        unset($data['Goods_Imgid']);
        // 启动事务
        Db::startTrans();
        try{
            Db::table('goods')->insert($data);
            $gid = Db::table('goods')->where($data)->value('Goods_Id');
            if($imgid){
                foreach($imgid as $key => $value){
                    Db::table('image')->where('Image_Id',$value)->update(['G_Id'=>$gid]);
                }
            }
            // 提交事务
            Db::commit();
            return json_encode(array('result'=>1));

        }catch(\Exception $e){
            // 回滚事务
            throw $e;
            Db::rollback();
            return json_encode(array('result'=>0));
        }       
    }
    public function gettype(){
        $type = Db::table('goodstype')->select();
        $a = array();
        foreach($type as $key => $value){
            $a[] = $value['GT_Type'];
        }
        return json_encode(array('info'=>$a));
    }

    public function upimg(){
        header('Content-type:text/html;charset=utf-8');
        $base64_image_content = $_POST['uploadedfile'];
        $gid = $_POST['G_Id'];
        //匹配出图片的格式
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
            $type = $result[2];
            $new_file = "public/images/goods/".date('Ymd',time())."/";
            if(!file_exists($new_file))
            {
                //检查是否有该文件夹，如果没有就创建，并给予最高权限
                mkdir($new_file, 0777,true);
            }
            $new_file = $new_file.time().".{$type}";
            if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
                $img['G_Id'] = $gid;
                $img['Image_Location'] = '/wxshop/'.$new_file;
                Db::table('image')->insert($img);
                $id = Db::table('image')->where($img)->value('Image_Id');
                return json_encode(array('result'=>'1','info'=>'/wxshop/'.$new_file,'id'=>$id));
            }else{
                return json_encode(array('result'=>'0','info'=>'上传失败'));
            }
        }else{
            return json_encode(array('result'=>'0','info'=>'上传失败'));
        }
    }
    public function delimg(){
        $del['G_Id'] = $_POST['G_Id'];
        $del['Image_Location'] = $_POST['Image_Location'];
        $id = Db::table('image')->where($del)->value('Image_Id');
        $rs = Db::table('image')->where($del)->delete();
        print_r($del);
        print_r($rs);
        if($rs){
            unlink(substr($del['Image_Location'],8));
            return json_encode(array('result'=>'1','id'=>$id));
        }else{
            return json_encode(array('result'=>'0'));
        }
    }
    public function updatelike(){
        $id = $_POST['Goods_Id'];
        $rs = Db::table('goods')->where('Goods_Id',$id)->update($_POST);
        $rss = Db::table('goods')->where('Goods_Id',$id)->where($_POST)->select();
        if($rss){
            return json_encode(array('result'=>1,'info'=>'评论成功'));
        }else{
            return json_encode(array('result'=>0,'info'=>'失败'));
        }
    }
    public function goodlikeB(){
        
        $id = $_POST['Goods_Id'];
        $rs = Db::table('goods')->where('Goods_Id',$id)->update(['Goods_Like'=>'1']);
        if($rs){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function goodlike(){
        $id = $_POST['Goods_Id'];
        $rs = Db::table('goods')->where('Goods_Id',$id)->update(['Goods_Like'=>'0']);
        if($rs){
            echo 1;
        }else{
            echo 0;
        }
    }
}
