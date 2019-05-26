<?php
namespace app\index\controller;
use \think\Controller;
use \think\Db;
use \think\Session;
class Img extends Sesspar
{   
    public function lunbo_show(){
        $rs = Db::table('banner')->paginate(10,false,['query'=>request()->param()]);
        $count = Db::table('banner')->count();
        $this->assign('list',$rs);
        $this->assign('count',$count);
		return $this->fetch();
    }
    public function type_show(){
        $rs = Db::table('goodstype')->paginate(10,false,['query'=>request()->param()]);
        $count = Db::table('goodstype')->count();
        $this->assign('list',$rs);
        $this->assign('count',$count);
		return $this->fetch();
    }
    public function banner_off(){
        $id = $_POST['id'];
        $rs = Db::table('banner')->where('Ban_Id',$id)->update(['Ban_Status'=>'0']);
        if($rs){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function banner_on(){
        $id = $_POST['id'];
        $rs = Db::table('banner')->where('Ban_Id',$id)->update(['Ban_Status'=>'1']);
        if($rs){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function banner_del(){
        $id = $_POST['id'];
        $img = Db::table('banner')->where('Ban_Id',$id)->find();
        $rs = Db::table('banner')->where('Ban_Id',$id)->delete();
        if($rs){
            unlink(substr($img['Ban_Url'],8));
            echo 1;
        }else{
            echo 0;
        }
    }
    public function type_del(){
        // var_dump(121);
        $id = $_POST['id'];
        $img = Db::table('goodstype')->where('GT_Id',$id)->find();
        $rs = Db::table('goodstype')->where('GT_Id',$id)->delete();
        if($rs){
            unlink(substr($img['GT_Image'],8));
            echo 1;
        }else{
            echo 0;
        }
    }
    public function delallban(){
        $id = $_POST['id'];
        Db::startTrans();
        try{
            foreach ($id as $key => $value) {
                $img = Db::table('banner')->where("Ban_Id",$value)->find();
                Db::table('banner')->where('Ban_Id',$value)->delete();
                unlink(substr($img['Ban_Url'],8));
            }
            Db::commit();
            echo 1;
        }catch(\Exception $e){
            Db::rollback();
            echo 0;
        }
    }
    public function delalltype(){
        $id = $_POST['id'];
        Db::startTrans();
        try{
            foreach ($id as $key => $value) {
                $img = Db::table('goodstype')->where("GT_Id",$value)->find();
                Db::table('goodstype')->where('GT_Id',$value)->delete();
                unlink(substr($img['GT_Image'],8));
            }
            Db::commit();
            echo 1;
        }catch(\Exception $e){
            Db::rollback();
            echo 0;
        }
    }
    public function upbanner(){
        $file = request()->file('upimg');
        $info = $file->validate(['ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH . 'public' . DS . 'images' . DS . 'banner');
        $src = '/wxshop/public/images/banner/'.$info->getSaveName();
        //$src = '/yhwl/a/public/uploads/'.$info->getSaveName();
        if($info){
            $data['Ban_Url'] = $src;
            $data['Ban_Time'] = time();
            Db::table('banner')->insert($data);
            $data['status'] = 1;
            $data['src'] = $src;  
            $data['content'] = "上传成功";  
            return $data; 
        }else{

            $data['status'] = 0;  
            $data['content'] = "上传失败";  
            return $data; 
        }
    }
    public function typedit($id){
        $rs = Db::table('goodstype')->where('GT_Id',$id)->find();
        $this->assign('msg',$rs);
		return $this->fetch();
    }
    public function upload(){
        $file = request()->file('upimg');
        $info = $file->validate(['ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH . 'public' . DS . 'images' . DS . 'type');
        $src = '/wxshop/public/images/type/'.$info->getSaveName();
        //$src = '/yhwl/a/public/uploads/'.$info->getSaveName();
        $src = str_replace('\\','/',$src);
        if($info){
            $data['status'] = 1;
            $data['src'] = $src;  
            $data['content'] = "上传成功";  
            return $data; 
        }else{

            $data['status'] = 0;  
            $data['content'] = "上传失败";  
            return $data; 
        }

    }
    public function delimg(){
        $imgpath = $_POST['imgpath'];
        if(unlink(strstr($imgpath,'public'))){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function editype(){
        $data = $_POST;
        Db::table('goodstype')->where('GT_Id',$data['GT_Id'])->update($data);
        $rs = Db::table('goodstype')->where($data)->select();
        if($rs){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function typeadd(){
        return $this->fetch();
    }
    public function addtype(){
        $data = $_POST;
        $rs = Db::table('goodstype')->insert($data);
        if($rs){
            echo 1;
        }else{
            echo 0;
        }
    }
}
