<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"C:\Users\Administrator\Desktop\work\wxshop/application/index\view\index\index.html";i:1529309844;}*/ ?>
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

</head>
<body class="login-bg">
    <div class="login">
        <div class="message">微信二手商城后台</div>
        <div id="darkbannerwrap"></div>
        
        <form id="form" class="layui-form"  onsubmit="return false" method="post">
            <input id="username" name="username" placeholder="用户名" value="root"  type="text" class="layui-input" >
            <hr class="hr15">
            <input id="password" name="password"  placeholder="密码" value="root" type="password" class="layui-input">
            <hr class="hr15">
            <input value="登录" id="login_btn" style="width:100%;" type="button">
            <hr class="hr20" >
        </form>
    </div>
    <script>

    $('#login_btn').click(function(){
            if($("#username").val()=='' || $("#password").val()==''){
                layer.msg('必填项不能为空');
                return false;
            }
            $.ajax({
                type:"POST",
                dataType:"json",
                url:"<?php echo url('index/index/login'); ?>",
                data:$('#form').serialize(),
                success:function(data){
                    if(data==1){
                        location.href="<?php echo url('index/main/index'); ?>"
                    }else{
                        layer.msg('账号或密码错误')
                    }
                },
                error:function(){
                    layer.msg('登录失败！')
                }
            })
        
    })
        
    </script>
</body>
</html>