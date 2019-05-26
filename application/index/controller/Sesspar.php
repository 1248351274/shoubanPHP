<?php
namespace app\index\controller;
use \think\Controller;
use \think\Db;
use \think\Session;
class Sesspar extends Controller
{
    public function __construct(){
        //调用父类构造
        parent::__construct();
        header("Content-Type:text/html; charset=utf-8");
        //判断SESSION是否存在
        if(!session('?username'))
        {
            $this->redirect('index/index/index', null, 3, '页面跳转中...'); 
        }
    }
}
