<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<link rel="stylesheet" href="/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" href="/admin/static/h-ui.admin/css/style.css" />
<title>{{$title or '在线教育平台管理系统'}}</title>
</head>
<body>
@yield('content')
<!--_footer 作为公共模版分离出去-->
<script src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script src="/admin/lib/layer/2.4/layer.js"></script>
<script src="/admin/static/h-ui/js/H-ui.min.js"></script>
<script src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->
@yield('footer-js')
{{--@yield('content') 视图占位符--}}
</body>
</html>
