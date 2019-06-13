<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\yanqingProTool\PHPTutorial\WWW\wxshop/application/index\view\member\index.html";i:1559699263;}*/ ?>
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
          <form class="layui-form layui-col-md12 x-so" action="<?php echo url('index/member/index'); ?>" method="get">
            <!-- <input class="layui-input" placeholder="开始日" name="start" value="<?php echo !empty($start)?$start : '';; ?>" id="start">
            <input class="layui-input" placeholder="截止日" name="end" value="<?php echo !empty($end)?$end : '';; ?>" id="end"> -->
            <input type="text" name="user"  placeholder="请输入用户名" value="<?php echo !empty($user)?$user : '';; ?>" autocomplete="off" class="layui-input">
            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
          </form>
        </div>
        <xblock>
          <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量停用</button>
          <span class="x-right" style="line-height:40px">共有数据：<?php echo $count; ?> 条</span>
        </xblock>
        <table class="layui-table">
          <thead>
            <tr>
              <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
              </th>
              <th>用户Id</th>
              <th>用户名</th>
              <th>用户头像</th>
              <th>用户地址</th>
              <th>用户电话</th>
              <th>用户余额</th>
              <th>用户状态</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
              <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $vo['User_Id']; ?>'><i class="layui-icon">&#xe605;</i></div>
              </td> 
              <td><?php echo $vo['User_Id']; ?></td>
              <td><?php echo $vo['User_Name']; ?></td>
              <td><img src="<?php echo $vo['User_Image']; ?>" style="height:35px" alt=""></td>
              <td><?php echo $vo['User_Address']; ?></td>
              <td><?php echo $vo['User_Tel']; ?></td>
              <td><?php echo $vo['User_Balance']; ?></td>
              <td class="td-status">
                <?php if($vo['User_Flag']==1): ?>
                <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>
                <?php else: ?>
                <span class="layui-btn layui-btn-disabled layui-btn-mini">已停用</span>
                <?php endif; ?>
              </td>
              <td class="td-manage">
                <?php if($vo['User_Flag']==1): ?>
                    <a style="text-decoration:none" onclick="member_stop(this,<?php echo $vo['User_Id']; ?>)" href="javascript:;" title="停用">
                        <i class="layui-icon">&#xe601;</i>
                    </a>
                <?php else: ?>
                    <a style="text-decoration:none" onclick="member_start(this,<?php echo $vo['User_Id']; ?>)" href="javascript:;" title="启用">
                        <i class="layui-icon">&#xe62f;</i>
                    </a>
                <?php endif; ?>
               
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
    function member_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){
            $.ajax({
                type:"POST",
                dataType:"json",
                url:"<?php echo url('index/member/user_off'); ?>",
                data:{id:id},
                success:function(data){
                    if(data==1){
                        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:;" title="启用"><i class="layui-icon">&#xe62f;</i></a>');
                        $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-disabled layui-btn-mini">已停用</span>');
                        $(obj).remove();
                        layer.msg('已停用!',{icon: 5,time:1000});
                    }else{
                        layer.msg('停用失败',{icon: 5,time:1000})
                    }
                },
                error:function(){
                    layer.msg('停用失败',{icon: 5,time:1000})
                }
            })
        });
    }
    function member_start(obj,id){
        layer.confirm('确认要启用吗？',function(index){
            $.ajax({
                type:"POST",
                dataType:"json",
                url:"<?php echo url('index/member/user_on'); ?>",
                data:{id:id},
                success:function(data){
                    if(data==1){
                        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="return member_stop(this,'+id+')" href="javascript:;" title="停用"><i class="layui-icon">&#xe601;</i></a>');
                        $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>');
                        $(obj).remove();
                        layer.msg('已启用!',{icon: 5,time:1000});
                    }else{
                        layer.msg('启用失败',{icon: 5,time:1000})
                    }
                },
                error:function(){
                    layer.msg('启用失败',{icon: 5,time:1000})
                }
            })
        });
    }
    //批量删除
    function delAll(){
        var data = tableCheck.getData();
        if(data==""){
            layer.msg('请选择停用项');
            return false
        }
        layer.confirm('确认要停用吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.ajax({
                type:"POST",
                dataType:"json",
                url:"<?php echo url('index/member/delalluser'); ?>",
                data:{id:data},
                success:function(data){
                    if(data==1){
                        layer.msg('停用成功', {icon: 1});
                        $(".layui-form-checked").not('.header').parents('tr').remove();
                    }else{
                        layer.msg('停用失败')
                    }
                },
                error:function(){
                    layer.msg('停用失败')
                }
            })
            
        });
    }

</script>
</body>
</html>