<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:bd="http://www.baidu.com/2010/xbdml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IEedge">
  <meta http-equiv="pragma" content="no-cache"> 
  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate"> 
  <meta http-equiv="expires" content="0">
  <title>安课云课堂 - 年轻人在线IT课堂</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <link rel="stylesheet" href="/mhome/css/bootstrap.min.css">
  <link rel="stylesheet" href="/mhome/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="/mhome/css/mylogin.css">
  <link rel="stylesheet" href="/mhome/css/componet.css">
  <link rel="stylesheet" href="/mhome/css/iconfont.css">
  <link rel="stylesheet" href="/mhome/css/header.css">
  <link rel="stylesheet" href="/mhome/css/footer.css">
  <link rel="stylesheet" href="/mhome/css/modal.css">
  <link rel="stylesheet" href="/mhome/css/base.css">
  <link rel="stylesheet" href="/mhome/css/order.css">
  <script src="/mhome/js/jquery-1.12.1.js" charset="utf-8"></script>
  <script src="/mhome/js/jquery.pagination.js" charset="UTF-8"></script>
  <script src="/mhome/js/layer.js"></script>
  <link rel="stylesheet" href="/mhome/css/layer.css" id="layui_layer_skinlayercss">
  <script src="/mhome/js/artTemplate.js"></script>
  <script src="/mhome/js/bootstrap.js" charset="utf-8"></script>
  <script src="/mhome/js/jquery.form.min.js" charset="utf-8"></script>
  <script src="/mhome/js/ajax.js" charset="utf-8"></script>
  <script src="/mhome/js/helpers.js"></script>
  <script src="/mhome/js/html5.js" charset="utf-8"></script>
  <script src="/mhome/js/modal.js" charset="utf-8"></script>
  <script src="/mhome/js/jquery.dotdotdot.js"></script>
  <script src="/mhome/js/order.js"></script>
</head>
<body>
<div class="main">
		<div class="main-title">
			<span>购买信息确认</span>
		</div>
		<div class="main-table">
			<div class="tr clearfix">
				<span class="td1">课程名称</span>
				<span class="td2">课程有效期</span>
				<span class="td3">原价</span>
				<span class="td4">优惠</span>
				<span class="td5">应付</span>
			</div>
			<div class="tab clearfix"><div class="td1">
        <span class="img"><img src="{{config('program.url')}}/{{ $goodsInfo->cover }}"></span>
        <table border="0" cellspacing="" cellpadding=""><tbody><tr><td><span class="name">{{ $goodsInfo->profession_name }}</span></td></tr></tbody></table></div><div class="td2">即日起至{{ date('Y-m-d',strtotime("+{$goodsInfo->expire_at}days" )) }}</div><div class="td3">￥{{ $goodsInfo->price }}</div><div class="td4">-￥{{ $goodsInfo->sale_price }}</div><div class="td5">￥{{ round($goodsInfo->price - $goodsInfo->sale_price ,2) }}</div></div>
		</div>
		<div class="sub clearfix"><a style="cursor:pointer" href="{{ url("/Home/Order/order/profession/{$goodsInfo->id}/make") }}">提交订单</a><p>应付金额：<span>￥{{ round($goodsInfo->price - $goodsInfo->sale_price ,2) }}</span></p></div>
	</div>

<script src="/mhome/js/header.js" charset="utf-8"></script>
<script src="/mhome/js/footer.js"></script><div class="footerDT"><footer><div class="content"><div class="content-item footer-bodys"><div class="content-item content-footer-link about-us"><ul class="gate"><li data-id="first" data-url="../html/aboutUs.html">关于我们<span>|</span></li><li data-id="two" data-url="../html/aboutUs.html">人才招聘<span>|</span></li><li data-id="three" data-url="../html/aboutUs.html">联系我们<span>|</span></li><li data-id="four" data-url="../html/aboutUs.html" class="noline">常见问题</li></ul></div><div class="trademark">京ICP备08001421号 京公网安备110108007702 Copyright @ 2016 安课教育平台 All Rights Reserved<span style="margin-right:5px;"></span><span id="cnzz_stat_icon_1260713417"><a href="http://www.cnzz.com/stat/website.php?web_id=1260713417" target="_blank" title="站长统计"><img border="0" hspace="0" vspace="0" src="/mhome/img/pic1.gif"></a></span></div></div></div></footer></div><script src="/mhome/js/z_stat.php"></script><script src="/mhome/js/core.php" charset="utf-8"></script>
<script src="/mhome/js/placeHolder.js"></script>
<script>
    $(function () {
        $('input').placeholder();
    });
</script>

<div id="modalBackground" class="hide"></div><div id="tousu" class="modalFather payment-modal hide"><div class="modalHeader"><span>投诉理由</span><i class="iconfont icon-guanbi payment-modal-close"></i></div><div class="modalBody"><p><span></span>我要投诉的内容涉及</p><label><div class="radio-cover"></div><input type="radio" class="cy-myprofile-myfom-dv-radio" name="gender" value="广告营销等垃圾信息" id="myradio1"><span>广告营销等垃圾信息</span></label><br><label><div class="radio-cover"></div><input type="radio" class="cy-myprofile-myfom-dv-radio" name="gender" value="抄袭内容" id="myradio2"><span>抄袭内容</span></label><br><label><div class="radio-cover"></div><input type="radio" class="cy-myprofile-myfom-dv-radio" name="gender" value="辱骂等不文明语言的人身攻击" id="myradio3"><span>辱骂等不文明语言的人身攻击</span></label><br><label><div class="radio-cover"></div><input type="radio" class="cy-myprofile-myfom-dv-radio" name="gender" value="色情或反动的违法信息" id="myradio4"><span>色情或反动的违法信息</span></label><br><label><div class="radio-cover"></div><input type="radio" class="cy-myprofile-myfom-dv-radio" name="gender" value="" id="myradio4"><span>其他</span><input type="text" class="comment-content"></label><br></div><div class="errorInfo"><img src="/mhome/img/alter_14.png" alt=""><span>请选择投诉理由</span></div><div class="modalFooter"><a>提交</a></div></div><div id="quxiaoshoucang" class="modalFather payment-modal hide"><div class="modalHeader"><i class="iconfont icon-guanbi payment-modal-close"></i></div><div class="modalBody"><div><i class="iconfont icon-wenhao"></i></div><p class="tipType">确定要取消收藏吗？</p></div><div class="modalFooter"><div><a class="yesBtn">确定</a></div><div><a class="notBtn">取消</a></div></div></div><div id="tousu1" class="modalFather payment-modal hide"><div class="modalHeader"><span>投诉理由</span><i class="iconfont icon-guanbi payment-modal-close"></i></div><div class="modalBody"><p><span></span>我要投诉的内容涉及</p><label><div class="radio-cover"></div><input type="radio" class="cy-myprofile-myfom-dv-radio" name="gender" value="广告营销等垃圾信息" id="myradio1"><span>广告营销等垃圾信息</span></label><br><label><div class="radio-cover"></div><input type="radio" class="cy-myprofile-myfom-dv-radio" name="gender" value="抄袭内容" id="myradio2"><span>抄袭内容</span></label><br><label><div class="radio-cover"></div><input type="radio" class="cy-myprofile-myfom-dv-radio" name="gender" value="辱骂等不文明语言的人身攻击" id="myradio3"><span>辱骂等不文明语言的人身攻击</span></label><br><label><div class="radio-cover"></div><input type="radio" class="cy-myprofile-myfom-dv-radio" name="gender" value="色情或反动的违法信息" id="myradio4"><span>色情或反动的违法信息</span></label><br><label><div class="radio-cover"></div><input type="radio" class="cy-myprofile-myfom-dv-radio" name="gender" value="" id="myradio4"><span>其他</span><input type="text" class="comment-content"></label></div><div class="errorInfo"><img src="/mhome/img/alter_14.png" alt=""><span>请选择投诉理由</span></div><div class="modalFooter"><a>提交</a></div></div><div class="browserBody" style="display:none;"><div class="bcgop"></div><div class="browserBody-text"><p>您目前使用的浏览器可能无法实现最佳浏览效果，建议使用Chrome(谷歌)、Firefox(火狐)、Edge、IE9及IE9以上版本浏览器。</p><a href="http://www.boxuegu.com/web/html/Download.html">立即升级</a><img src="/mhome/img/BWcolse.png"></div></div></body></html>
