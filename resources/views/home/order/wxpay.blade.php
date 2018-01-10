<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>微信支付页面</title>
  <script src="/mhome/js/jquery-1.12.1.js" charset="utf-8"></script>
  <link rel="stylesheet" href="/mhome/css/layer.css">
  <script src="/mhome/js/layer.js"></script>
  <style>
    img{
      position: fixed;
      top: 0;
      right: 0;
      left: 0;
      bottom: 0;
      margin: auto;
    }
  </style>
</head>
<body>
  <img src="http://paysdk.weixin.qq.com/example/qrcode.php?data={{ $url }}" style="width:150px;height:150px;"/>
  <script>
    $(function(){
      var timer = setInterval(function(){
        $.get('query/{{ $orderInfo->id }}',function(msg){
          if( msg['status'] ){
            clearInterval(timer);
            layer.msg(msg['message'],{icon:1,time:3000},function(){
              // 在弹窗显示支付结果以后，自动跳转到对应的会员中心里面去
              parent.location.href = "{{ url('Home/Order/member') }}";
            });
          }
        },'json');
      }, 3000);
    });
  </script>
</body>
</html>
