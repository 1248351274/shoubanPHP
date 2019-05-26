<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"C:\Users\Administrator\Desktop\work\wxshop/application/index\view\order\index.html";i:1529309231;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>微信二手商城后台</title>
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
    <script type="text/javascript" src="/wxshop/public/static/js/jquery.form.js"></script>
    <style>
        table{
            table-layout:fixed;
        }
        td{
            overflow:hidden;text-overflow:ellipsis;white-space:nowrap; 
        }
    </style>
</head>
<body>
    <div class="x-nav">
        <span class="layui-breadcrumb">
          <a href="">首页</a>
          <a href="">演示</a>
          <a>
            <cite>导航元素</cite></a>
        </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
          <i class="layui-icon" style="line-height:30px">ဂ</i></a>
      </div>
      <div class="x-body">
        <div class="layui-row">
          <form class="layui-form layui-col-md12 x-so" action="<?php echo url('index/order/index'); ?>" method="get">
            <input class="layui-input" placeholder="开始日" name="start" value="<?php echo !empty($start)?$start : '';; ?>" id="start">
            <input class="layui-input" placeholder="截止日" name="end" value="<?php echo !empty($end)?$end : '';; ?>" id="end">
            <input type="text" name="orderid"  placeholder="请输入订单号" value="<?php echo !empty($orderid)?$orderid : '';; ?>" autocomplete="off" class="layui-input">
            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
          </form>
        </div>
        <xblock>
          
          <span class="x-right" style="line-height:40px">共有数据：<?php echo $count; ?> 条</span>
        </xblock>
        <table class="layui-table">
          <thead>
            <tr>
              
              <th>订单号</th>
              <th>商品名称</th>
              <th>所属店铺</th>
              <th>所属用户</th>
              <th>订单数量</th>
              <th>订单金额</th>
              <th>订单时间</th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
               
              <td><?php echo $vo['Order_Id']; ?></td>
              <td><?php echo $vo['G_Name']; ?></td>
              <td><?php echo $vo['Shop_Name']; ?></td>
              <td><?php echo $vo['User_Name']; ?></td>
              <td><?php echo $vo['Order_Num']; ?></td>
              <td><?php echo $vo['Order_Price']; ?></td>
              <td><?php echo date("Y-m-d H:i:s",$vo['Order_Time']); ?></td>
              
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            
          </tbody>
        </table>
        <div class="page">
          <div>
                <?php echo $list->render(); ?> 
            <!-- <a class="prev" href="">&lt;&lt;</a>
            <a class="num" href="">1</a>
            <span class="current">2</span>
            <a class="num" href="">3</a>
            <a class="num" href="">489</a>
            <a class="next" href="">&gt;&gt;</a> -->
          </div>
        </div>
  
      </div>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        
        //执行一个laydate实例
        laydate.render({
        elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
        elem: '#end' //指定元素
        });
    });
  
</script>
</body>
</html>