<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"D:\yanqingProTool\PHPTutorial\WWW\wxshop/application/index\view\welcome\index.html";i:1529319161;}*/ ?>
<!DOCTYPE html>
<html>
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
    <body>
        <div class="x-body">
            <blockquote class="layui-elem-quote">欢迎登录微信二手商城后台模版</blockquote>
            <fieldset class="layui-elem-field">
              <legend>信息统计</legend>
              <div class="layui-field-box">
                <table class="layui-table" lay-even>
                    <thead>
                        <tr>
                            <th>统计</th>
                            <th>订单数</th>
                            <th>交易额</th>
                            <th>待审核商品数</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>今日</td>
                            <td><?php echo $msg['order_num1']; ?></td>
                            <td><?php echo $msg['order_tot1']; ?></td>
                            <td><?php echo $msg['goods_sh1']; ?></td>
                        </tr>
                        <tr>
                            <td>本周</td>
                            <td><?php echo $msg['order_num2']; ?></td>
                            <td><?php echo $msg['order_tot2']; ?></td>
                            <td><?php echo $msg['goods_sh2']; ?></td>
                        </tr>
                        
                    </tbody>
                </table>
                
              </div>
            </fieldset>
            
            
        </div>
    
    </body>
</html>