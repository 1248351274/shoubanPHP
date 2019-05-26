<?php
namespace app\index\controller;
use \think\Controller;
use \think\Db;
use \think\Session;
class Order extends Sesspar
{
    public function index()
    {
        $data = array();
        if(isset($_GET['orderid']) && $_GET['orderid']!=''){
            $data['Order_Id'] = array('like',"%".$_GET['orderid']."%");
            $this->assign('orderid',$_GET['orderid']);
        }
        if(isset($_GET['start'])){
            if($_GET['start']!=''){
                $start = strtotime($_GET['start']);
                $this->assign('start',$_GET['start']);
            }else{
                $start = 0;
            }
        }else{
            $start = 0;
        }
        if(isset($_GET['end'])){
            if($_GET['end']!=''){
                $end = strtotime($_GET['end'])+86399;
                $this->assign('end',$_GET['end']);
            }else{
                $end = time();
            }
        }else{
            $end = time();
        }
        $data['Order_Time'] = array('between',"$start,$end");
        $rs = Db::table('order')
                ->join('shop','order.Shop_Id=shop.Shop_Id')
                ->join('user','order.U_Id=User_Id')
                ->order('Order_Id desc')
                ->where($data)
    			->paginate(10,false,['query'=>request()->param()]);
        $count = Db::table('order')
                ->join('shop','order.Shop_Id=shop.Shop_Id')
                ->join('user','order.U_Id=User_Id')
                ->where($data)
                ->count();
    	$this->assign('count',$count);
    	$this->assign('list',$rs);
		return $this->fetch();
    }
    
}
