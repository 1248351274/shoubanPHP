<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"C:\Users\Administrator\Desktop\work\wxshop/application/index\view\img\lunbo_show.html";i:1528901804;}*/ ?>
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
        <!-- <div class="layui-row">
          <form class="layui-form layui-col-md12 x-so">
            <input class="layui-input" placeholder="开始日" name="start" id="start">
            <input class="layui-input" placeholder="截止日" name="end" id="end">
            <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
          </form>
        </div> -->
        <xblock>
          <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
          
          <form id="upload" style="padding-left: 120px;" style="display:block;padding: 0;width:90px;height:40px" method="post" enctype="multipart/form-data" action="<?php echo url('index/img/upbanner'); ?>">
               <div style="background-color:#009688;width:90px;height:38px;text-align:center;line-height: 38px;color:#fff;font-size: 14px;display:block;margin-top:-38px;position:relative;">
                    <i class="layui-icon"></i>添加
                    <input type="file" style="opacity: 0;width:90px;height:38px;position: absolute;top:0px;left:0px"  id="upimg" name="upimg">
               </div>
          </form>
          <span class="x-right" style="line-height:40px">共有数据：<?php echo $count; ?> 条</span>
        </xblock>
        <table class="layui-table">
          <thead>
            <tr>
              <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
              </th>
              <th>ID</th>
              <th>图片</th>
            
              <th>加入时间</th>
              <th>状态</th>
              <th>操作</th></tr>
          </thead>
          <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
              <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $vo['Ban_Id']; ?>'><i class="layui-icon">&#xe605;</i></div>
              </td>
              <td><?php echo $i; ?></td>
              <td><img style="width:100px;height:33.59px;" src="<?php echo $vo['Ban_Url']; ?>" alt="图片丢失"></td>

              <td><?php echo date("Y-m-d H:i:s",$vo['Ban_Time']); ?></td>
              <td class="td-status">
                <?php if($vo['Ban_Status']==1): ?>
                <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>
                <?php else: ?>
                <span class="layui-btn layui-btn-disabled layui-btn-mini">已停用</span>
                <?php endif; ?>
              </td>
              <td class="td-manage">
                <?php if($vo['Ban_Status']==1): ?>
                    <a style="text-decoration:none" onclick="member_stop(this,<?php echo $vo['Ban_Id']; ?>)" href="javascript:;" title="停用">
                        <i class="layui-icon">&#xe601;</i>
                    </a>
                <?php else: ?>
                    <a style="text-decoration:none" onclick="member_start(this,<?php echo $vo['Ban_Id']; ?>)" href="javascript:;" title="启用">
                        <i class="layui-icon">&#xe62f;</i>
                    </a>
                <?php endif; ?>
                <!-- <a onclick="member_stop(this,'10001')" href="javascript:;"  title="启用">
                  <i class="layui-icon">&#xe601;</i>
                </a> -->
                &nbsp;&nbsp;
                <a title="删除" onclick="member_del(this,<?php echo $vo['Ban_Id']; ?>)" href="javascript:;">
                  <i class="layui-icon">&#xe640;</i>
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
    $('#upimg').change(function(){
        $('#upload').ajaxSubmit({
            dataType:'json',
            success:function(data){    
                if(data.status==1){
                    location.reload();
                    layer.msg(data.content);
                }else{
                    layer.msg(data.content);
                }
            },
            error:function(){
                layer.msg('上传失败');
            }
        })
    });
    function member_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){
            $.ajax({
                type:"POST",
                dataType:"json",
                url:"<?php echo url('index/img/banner_off'); ?>",
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
                url:"<?php echo url('index/img/banner_on'); ?>",
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
                url:"<?php echo url('index/img/delallban'); ?>",
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
      /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $.ajax({
                type:"POST",
                dataType:"json",
                url:"<?php echo url('index/img/banner_del'); ?>",
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
    function member_add (title,url,w,h) {
        x_admin_show(title,url,w,h); 
    } 
</script>
</body>
</html>