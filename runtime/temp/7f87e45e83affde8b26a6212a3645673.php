<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"C:\Users\Administrator\Desktop\work\wxshop/application/index\view\admin\add_show.html";i:1529315677;}*/ ?>
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

</head>
<body>
        <div class="x-body">
            <form class="layui-form" id="form">
                <div class="layui-form-item">
                    <label class="layui-form-label">
                        <span class="x-red">*</span>管理员账号
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="Admin_Name" name="Admin_Name" required="" 
                        autocomplete="off" class="layui-input">
                    </div>
                    
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">
                        <span class="x-red">*</span>管理员密码
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="Admin_Password" name="Admin_Password" required="" 
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button  class="layui-btn" id = 'addbtn'>
                        添加
                    </button>
                </div>
            </form>
        </div>
<script>
    $('#addbtn').click(function(){
        
        $.ajax({
            type:"POST",
            dataType:"json",
            url:"<?php echo url('index/Admin/add'); ?>",
            data:$('#form').serialize(),
            success:function(data){
                if(data==1){
                    parent.location.reload();
                }else{
                    layer.msg('修改失败')
                }
            },
            error:function(){
                layer.msg('修改失败！')
            }
        })
    })
</script>
</body>
</html>