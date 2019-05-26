<?php
namespace app\index\controller;
use \think\Controller;
use \think\Db;
use \think\Session;
class Welcome extends Controller
{
    public function index()
    {
        $start1 = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $end1 = time();
        $start2 = strtotime(date('Y-m-d', strtotime("this week Monday", time())));
        $end2 = time();
        $where1['Order_Time'] = array('between',"$start1,$end1");
        $where2['Order_Time'] = array('between',"$start2,$end2");
        $msg['order_num1'] = Db::table('order')->where($where1)->count();
        $msg['order_tot1'] = Db::table('order')->where($where1)->sum('Order_Price');
        $msg['goods_sh1'] = Db::table('goods')->where('Goods_Flag',0)->count();
        $msg['order_num2'] = Db::table('order')->where($where2)->count();
        $msg['order_tot2'] = Db::table('order')->where($where2)->sum('Order_Price');
        $msg['goods_sh2'] = $msg['goods_sh1'];
    	$this->assign('msg',$msg);
		return $this->fetch();
    }
    
}
