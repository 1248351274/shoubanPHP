<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"C:\Users\Administrator\Desktop\work\wxshop/application/index\view\admin\index.html";i:1529315904;}*/ ?>
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
          <form class="layui-form layui-col-md12 x-so" action="<?php echo url('index/admin/index'); ?>" method="get">
            <!-- <input class="layui-input" placeholder="开始日" name="start" value="<?php echo !empty($start)?$start : '';; ?>" id="start">
            <input class="layui-input" placeholder="截止日" name="end" value="<?php echo !empty($end)?$end : '';; ?>" id="end"> -->
            <input type="text" name="admin"  placeholder="请输入用户名" value="<?php echo !empty($admin)?$admin : '';; ?>" autocomplete="off" class="layui-input">
            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
          </form>
        </div>
        <xblock>
          <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
          <button class="layui-btn" onclick="x_admin_show('添加管理员','<?php echo url("index/admin/add_show"); ?>',600,400)"><i class="layui-icon"></i>添加</button>
          <span class="x-right" style="line-height:40px">共有数据：<?php echo $count; ?> 条</span>
        </xblock>
        <table class="layui-table">
          <thead>
            <tr>
              <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
              </th>
              <th>管理员账号</th>
              <th>最后登录时间</th>
              <th>账号状态</th>
              
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
              <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $vo['Admin_Id']; ?>'><i class="layui-icon">&#xe605;</i></div>
              </td> 
              
              <td><?php echo $vo['Admin_Name']; ?></td>
              
              <td><?php echo date("Y-m-d H:i:s",$vo['Admin_LastTime']); ?></td>
              <td class="td-status">
                <?php if($vo['Admin_Flag']==1): ?>
                <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>
                <?php else: ?>
                <span class="layui-btn layui-btn-disabled layui-btn-mini">已停用</span>
                <?php endif; ?>
              </td>
              <td class="td-manage">
                <?php if($vo['Admin_Flag']==1): ?>
                    <a style="text-decoration:none" onclick="member_stop(this,<?php echo $vo['Admin_Id']; ?>)" href="javascript:;" title="停用">
                        <i class="layui-icon">&#xe601;</i>
                    </a>
                <?php else: ?>
                    <a style="text-decoration:none" onclick="member_start(this,<?php echo $vo['Admin_Id']; ?>)" href="javascript:;" title="启用">
                        <i class="layui-icon">&#xe62f;</i>
                    </a>
                <?php endif; ?>
                &nbsp;&nbsp;
                <a title="删除" onclick="member_del(this,<?php echo $vo['Admin_Id']; ?>)" href="javascript:;">
                    <i class="layui-icon">&#xe640;</i>
                </a>
                &nbsp;&nbsp;
                <a title="编辑"  onclick="x_admin_show('编辑','<?php echo url("index/admin/edit_show",['id'=>$vo['Admin_Id']]); ?>',600,400)" href="javascript:;">
                    <i class="layui-icon">&#xe642;</i>
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

    function member_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){
            $.ajax({
                type:"POST",
                dataType:"json",
                url:"<?php echo url('index/admin/admin_off'); ?>",
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
                url:"<?php echo url('index/admin/admin_on'); ?>",
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
            layer.msg('请选择删除项');
            return false
        }
        layer.confirm('确认要删除吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.ajax({
                type:"POST",
                dataType:"json",
                url:"<?php echo url('index/admin/delalladmin'); ?>",
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
  /*删除*/
  function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $.ajax({
                type:"POST",
                dataType:"json",
                url:"<?php echo url('index/admin/admin_del'); ?>",
                data:{id:id},
                success:function(data){
                    if(data==1){
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
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
</script>
</body>
</html>