<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"C:\Users\Administrator\Desktop\work\wxshop/application/index\view\img\typeadd.html";i:1528954555;}*/ ?>
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
                <div class="layui-form-item">
                    <label for="GT_Type" class="layui-form-label">
                        <span class="x-red">*</span>类型
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="GT_Type" name="GT_Type" required="" 
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图片</label>
                        <img src="" id="img" style="width: 100px;height: 100px" alt="请选择图片">
                        <button id='delbtn' class="layui-btn">删除图片</button>
                        <form id="upload" style="padding-left: 120px;"  method="post" enctype="multipart/form-data" action="<?php echo url('index/Img/upload'); ?>">
                            <input type="file" id="upimg" name="upimg">
                        </form>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button  class="layui-btn" id = 'addbtn'>
                        修改
                    </button>
                </div>
           
        </div>
<script>
    $(document).ready(function(){
        if($('#img').attr('src')==''){
            $('#delbtn').hide();
        }
    })
    $('#upimg').change(function(){
        $('#upload').ajaxSubmit({
            dataType:'json',
            success:function(data){
                if(data.status==1){
                    var src=data.src;
                    $('#img').attr('src',src);
                    $('#delbtn').show();
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
    $('#delbtn').click(function(){
        $.post(
            "<?php echo url('index/Img/delimg'); ?>",
            {imgpath:$('#img').attr('src')},
            function(data){
                if(data==1){
                    layer.msg('删除成功');
                    $('#img').attr('src','');
                    $('#delbtn').hide();
                }else{
                    layer.msg('删除失败');
                }
            }
        )
    })
    $('#addbtn').click(function(){
        
        $.ajax({
            type:"POST",
            dataType:"json",
            url:"<?php echo url('index/Img/addtype'); ?>",
            data:{GT_Type:$('#GT_Type').val(),GT_Image:$('#img').attr('src')},
            // data:$('#form').serialize(),
            success:function(data){
                if(data==1){
                    parent.location.reload();
                }else{
                    layer.msg('添加失败')
                }
            },
            error:function(){
                layer.msg('添加失败')
            }
        })
    })
</script>
</body>
</html>