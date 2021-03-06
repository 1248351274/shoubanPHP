<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"D:\yanqingProTool\PHPTutorial\WWW\wxshop/application/index\view\img\type_show.html";i:1559699207;}*/ ?>
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
          <button class="layui-btn" onclick="x_admin_show('添加类型','<?php echo url("index/img/typeadd"); ?>',600,400)"><i class="layui-icon"></i>添加</button>
          
          <span class="x-right" style="line-height:40px">共有数据：<?php echo $count; ?> 条</span>
        </xblock>
        <table class="layui-table">
          <thead>
            <tr>
              <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
              </th>
              <th>ID</th>
              <th>类型</th>
            
              <th>图片</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
              <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $vo['GT_Id']; ?>'><i class="layui-icon">&#xe605;</i></div>
              </td>
              <td><?php echo $i; ?></td>
              <td><?php echo $vo['GT_Type']; ?></td>
              <td><img style="width:35;height:35px;" src="<?php echo $vo['GT_Image']; ?>" alt="图片丢失"></td>
              <td class="td-manage">
                <a title="编辑"  onclick="x_admin_show('编辑','<?php echo url("index/img/typedit",['id'=>$vo['GT_Id']]); ?>',600,400)" 
                    href="javascript:;">
                    <i class="layui-icon">&#xe642;</i>
                </a>
                &nbsp;&nbsp;
                <a title="删除" onclick="member_del(this,<?php echo $vo['GT_Id']; ?>)" href="javascript:;">
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
                url:"<?php echo url('index/img/delalltype'); ?>",
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
                url:"<?php echo url('index/img/type_del'); ?>",
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