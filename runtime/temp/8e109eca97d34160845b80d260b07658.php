<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\yanqingProTool\PHPTutorial\WWW\wxshop/application/index\view\main\index.html";i:1560498402;}*/ ?>
<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>手办控后台</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="shortcut icon" href="/favicon.ico" type="/wxshop/public/static/images/x-icon" />
    <link rel="stylesheet" href="/wxshop/public/static/css/font.css">
    <link rel="stylesheet" href="/wxshop/public/static/css/xadmin.css">
    <script type="text/javascript" src="/wxshop/public/static/js/jquery.min.js"></script>
    <script src="/wxshop/public/static/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/wxshop/public/static/js/xadmin.js"></script>

</head>
<body>
    <!-- 顶部开始 -->
    <div class="container">
        <div class="logo"><a href="./index.html">Welcome</a></div>
        <div class="left_open">
            <i title="展开左侧栏" class="iconfont">&#xe699;</i>
        </div>
        <ul class="layui-nav left fast-add" lay-filter="">
          <li class="layui-nav-item">
            <a href="javascript:;">+新增</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
              <dd><a onclick="x_admin_show('资讯','http://www.baidu.com')"><i class="iconfont">&#xe6a2;</i>资讯</a></dd>
              <dd><a onclick="x_admin_show('图片','http://www.baidu.com')"><i class="iconfont">&#xe6a8;</i>图片</a></dd>
               <dd><a onclick="x_admin_show('用户','http://www.baidu.com')"><i class="iconfont">&#xe6b8;</i>用户</a></dd>
            </dl>
          </li>
        </ul>
        <ul class="layui-nav right" lay-filter="">
          <li class="layui-nav-item">
            <a href="javascript:;"><?php echo \think\Session::get('username'); ?></a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
              <dd><a href="javascript:;" onclick="x_admin_show('修改密码','<?php echo url("index/main/edit_show"); ?>',600,400)">修改密码</a></dd>
              <dd><a href="<?php echo url('index/index/login_out'); ?>">切换帐号</a></dd>
              <dd><a href="<?php echo url('index/index/login_out'); ?>">退出</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item to-index"><a href="">刷新</a></li>
        </ul>
        
    </div>
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
     <!-- 左侧菜单开始 -->
    <div class="left-nav">
      <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>手办管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('index/goods/goodslist'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>手办列表</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="<?php echo url('index/goods/shlist'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>手办审核</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="layui-icon">&#xe64a;</i>
                    <cite>图片管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('index/img/lunbo_show'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>轮播图</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('index/img/type_show'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>类别图</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="layui-icon">&#xe657;</i>
                    <cite>订单管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('index/order/index'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>订单列表</cite>
                            
                        </a>
                    </li >    
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b8;</i>
                    <cite>会员管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('index/member/index'); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>会员列表</cite>
                            
                        </a>
                    </li >    
                </ul>
            </li>
 
            <?php if((session('power')=='1')): ?>
                <li>
                    <a href="javascript:;">
                        <i class="iconfont">&#xe726;</i>
                        <cite>管理员管理</cite>
                        <i class="iconfont nav_right">&#xe697;</i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a _href="<?php echo url('index/admin/index'); ?>">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>管理员列表</cite>
                            </a>
                        </li >
                    </ul>
                </li>
            <?php else: endif; ?>
            
            
        </ul>
      </div>
    </div>
    <!-- <div class="x-slide_left"></div> -->
    <!-- 左侧菜单结束 -->
    <!-- 右侧主体开始 -->
    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
          <ul class="layui-tab-title">
            <li>我的桌面</li>
          </ul>
          <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='<?php echo url('index/welcome/index'); ?>' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
          </div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <!-- 右侧主体结束 -->
    <!-- 中部结束 -->
    <!-- 底部开始 -->
    <div class="footer">
        <div class="copyright">Copyright ©2018 hcb v2.3 All Rights Reserved</div>  
    </div>
    <!-- 底部结束 -->
<script>


 /*用户-修改*/
function member_edit (title,url,id,w,h) {
        x_admin_show(title,url,w,h); 
    }
function ifr_reload(){
    var url = $('.current:last>a').attr('href');
    if(url=='javascript:;'){
        url=$("#rifr").attr("src");
    }
    $("#rifr").attr("src",url);
}
</script>
</body>
</html>