<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"C:\Users\Administrator\Desktop\work\wxshop/application/index\view\goods\shlist.html";i:1529307502;}*/ ?>
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
            <form class="layui-form layui-col-md12 x-so" action="<?php echo url('index/goods/shlist'); ?>" method="get">
                <!-- <input class="layui-input" placeholder="开始日" name="start" id="start">
                <input class="layui-input" placeholder="截止日" name="end" id="end"> -->
                <input type="text" name="good"  placeholder="请输入商品名" value="<?php echo !empty($good)?$good : '';; ?>" autocomplete="off" class="layui-input">
                <input type="text" name="user"  placeholder="请输入用户名" value="<?php echo !empty($user)?$user : '';; ?>" autocomplete="off" class="layui-input">
                <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </form>
        </div>
        <xblock>
          <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
          
          
          <span class="x-right" style="line-height:40px">共有数据：<?php echo $count; ?> 条</span>
        </xblock>
        <table class="layui-table">
          <thead>
            <tr>
              <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
              </th>
              <th>商品名称</th>
              <th>数量</th>
              <th>价格</th>
              <th>简介</th>
              <th>类型</th>
              <th>拥有者</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $vo['Goods_Id']; ?>'><i class="layui-icon">&#xe605;</i></div>
                </td>
              <td><?php echo $vo['Goods_Name']; ?></td>
              <td><?php echo $vo['Goods_Num']; ?></td>
              <td><?php echo $vo['Goods_Price']; ?></td>
              <td><?php echo $vo['Goods_Remarks']; ?></td>
              <td><?php echo $vo['GT_Type']; ?></td>
              <td><?php echo $vo['Goods_Name']; ?></td>
              <td class="td-manage">
        
                <a title="审核通过" onclick="member_tg(this,<?php echo $vo['Goods_Id']; ?>)" href="javascript:;">
                    <i class="layui-icon">&#xe616;</i>
                </a>
                &nbsp;&nbsp;
                <a title="审核不通过" onclick="member_btg(this,<?php echo $vo['Goods_Id']; ?>)" href="javascript:;">
                    <i class="layui-icon">&#x1007;</i>
                </a>
              </td>
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
    //批量删除
    function delAll(){
        var data = tableCheck.getData();
        if(data==""){
            layer.msg('请选择删除项');
            return false
        }
        layer.confirm('确认要删除吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.ajax({
                type:"POST",
                dataType:"json",
                url:"<?php echo url('index/company/delallgoo'); ?>",
                data:{id:data},
                success:function(data){
                    if(data==1){
                        layer.msg('删除成功', {icon: 1});
                        $(".layui-form-checked").not('.header').parents('tr').remove();
                    }else{
                        layer.msg('删除失败')
                    }
                },
                error:function(){
                    layer.msg('删除失败')
                }
            })
            
        });
    }

      /*用户-审核tg*/
    function member_tg(obj,id){
        layer.confirm('确认要审核吗？',function(index){
            //发异步删除数据
            $.ajax({
                type:"POST",
                dataType:"json",
                url:"<?php echo url('index/goods/tg'); ?>",
                data:{id:id},
                success:function(data){
                    if(data==1){
                        $(obj).parents("tr").remove();
                        layer.msg('已审核!',{icon:1,time:1000});
                    }else{
                        layer.msg('审核失败')
                    }
                },
                error:function(){
                    layer.msg('审核失败')
                }
            })
            
        });
    }
      /*用户-审核btg*/
      function member_btg(obj,id){
        layer.confirm('确认要拒绝吗？',function(index){
            //发异步删除数据
            $.ajax({
                type:"POST",
                dataType:"json",
                url:"<?php echo url('index/goods/btg'); ?>",
                data:{id:id},
                success:function(data){
                    if(data==1){
                        $(obj).parents("tr").remove();
                        layer.msg('拒绝成功!',{icon:1,time:1000});
                    }else{
                        layer.msg('拒绝失败')
                    }
                },
                error:function(){
                    layer.msg('拒绝失败')
                }
            })
            
        });
    }
</script>
</body>
</html>