<!DOCTYPE html>
<html>
<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
		<title>{{ $lesson->lesson_name }}- 安课在线课堂</title>
		<meta name="keywords" content="">
		<meta name="description" content="">
		<meta name="renderer" content="webkit">
		<link rel="stylesheet" href="/mhome/css/bootstrap.min.css">
		<link rel="stylesheet" href="/mhome/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="/mhome/css/mylogin.css">
		<link rel="stylesheet" href="/mhome/css/componet.css">
		<link rel="stylesheet" href="/mhome/css/footer.css">
		<link rel="stylesheet" href="/mhome/css/iconfont.css">
		<link rel="stylesheet" href="/mhome/css/font-awesome.css">
		<link rel="stylesheet" href="/mhome/css/simditor.css">
		<link rel="stylesheet" href="/mhome/css/video.css">

		<script src="/mhome/js/jquery-1.12.1.js" charset="utf-8"></script>
		<script src="/mhome/js/artTemplate.js" charset="utf-8"></script>
		<script src="/mhome/js/jquery.pagination.js"></script>
		<script src="/mhome/js/jquery.dotdotdot.js"></script>
		<script src="/mhome/js/bootstrap.js"></script>
		<script src="/mhome/js/layer.js"></script>
		<link rel="stylesheet" href="/mhome/css/layer.css" id="layui_layer_skinlayercss">
		<script src="/mhome/js/jquery.form.min.js"></script>
		<script src="/mhome/js/module.js"></script>
		<script src="/mhome/js/simditor.js"></script>
		<script src="/mhome/js/uploader.js"></script>
		<script src="/mhome/js/jquery.nicescroll.js"></script>
		<script src="/mhome/js/ajax.js" charset="utf-8"></script>
		<script src="/mhome/js/helpers.js"></script>
		<script src="/mhome/js/html5.js" charset="utf-8"></script>
	</head>

	<body>
		<div class="rTips"></div>
		<div class="mask"></div>
		<div class="header">
			<div class="headerBody">
				<a href="{{ url()->previous() }}" ><img src="/mhome/img/fanhui.png">返回列表</a>
				<span class="headerBody-title">{{ $lesson->lesson_name }}</span>
				<div class="rightT">
					<p title="{{ $lesson->lesson_name }}">{{ $lesson->lesson_name }}</p>
					{{--<span><i></i></span>--}}
				</div>
			</div>
		</div>
		<div class="videoBody">
			<div class="videoBody-top" style="height: 519px;">
			{{-- 直播视频的播放 --}}
			<div id="live" style="height: 100%"></div>
			<script src="/mhome/ckplayer/ckplayer.js" charset="utf-8"></script>
			<script>
				var flashvars={
					f:'{{config('program.url')}}/{{ $lesson->video_address }}', // 视频地址
					c:0,
					b:1,
					i:'{{config('program.url')}}/{{ $lesson->lesson_name }}' // 封面图
					};
					// html5的播放地址
					var video=['{{config('program.url')}}/{{ $lesson->video_address }}'];
					// 实例化播放器
					CKobject.embed('/mhome/ckplayer/ckplayer.swf','live','ckplayer_live','100%','519',false,flashvars,video);
			</script>
			</div>
			<div class="videoBody-bottom">
				<div class="videoBody-bottom-left">
					<div class="videoBody-bottom-left-title">
						<span data-md="pingjia" class="act">评价</span>
						<span data-md="biji" class="">笔记</span>
						<span data-md="wenda" class="">问答</span>
					</div>
					<div>
						<div class="pingjia clearfix" data-md="pingjia" style="display: block;">
							<div class="videoBody-bottom-left-release">
								<p>视频评分：<em class="releaseStars" style="margin-left:17px;"><i class="iconfont icon-shoucang" style="margin-right:5px;color:#ffcf2e;cursor:pointer"></i><i class="iconfont icon-shoucang" style="margin-right:5px;color:#ffcf2e;cursor:pointer"></i><i class="iconfont icon-shoucang" style="margin-right:5px;color:#ffcf2e;cursor:pointer"></i><i class="iconfont icon-shoucang" style="margin-right:5px;color:#ffcf2e;cursor:pointer"></i><i class="iconfont icon-shoucang" style="margin-right:5px;color:#ffcf2e;cursor:pointer"></i></em><span class="starText">五星好评！相信品牌的力量！</span></p>
								<span style="margin-top: 40px;margin-top: 40px;float: left;font-size: 14px;">学习感受：</span>
								<textarea style="resize: none;" class="textStatus" placeholder="写下体验之后的真实感受，帮助我们不断优化课程产品，为大家提供更优质的服务~" maxlength="200" wrap="hard" onkeyup="countChar()"></textarea>
								<span class="tishiText">可以输入<span id="textCounter">200</span>字</span>
								<p><em class="tipRelease" style="display: none;">请写下您不满意的地方，我们将努力改进！</em><span class="getRelease">提交评论</span></p>
							</div>
							<div class="videoBody-bottom-left-list"><div class="freeNull"><img src="/mhome/img/nullpl.png"><p>亲，快点来抢沙发哦~~</p></div></div>
						</div>
						<div class="biji clearfix" data-md="biji" style="display: none;">
							<div class="biji-title">
								<span class="act" data-type="0">全部笔记</span><em>|</em><span data-type="1">我的笔记</span>
							</div>
							<div class="tips">
								<p>确定删除此条笔记？</p>
								<div>
									<span class="ok">确定</span>
									<span class="no">取消</span>
								</div>
							</div>
							<div class="biji-content clearfix"><div class="page-no-result"><img src="/mhome/img/my_nodata.png"><div class="no-title">暂无数据</div></div></div>
						</div>
						<div class="wenda clearfix" data-md="wenda" style="display: none;">
							<div class="tips">
								<p>确定删除此条问答？</p>
								<div>
									<span class="ok">确定</span>
									<span class="no">取消</span>
								</div>
							</div>
							<div class="wenda-title">
								<span class="act" data-type="1">全部</span><em>|</em><span data-type="2">我的提问</span>
							</div>
							<div class="wenda-content clearfix"><div class="page-no-result"><img src="/mhome/img/my_nodata.png"><div class="no-title">暂无数据</div></div></div>
						</div>
					</div>
					<div class="pages" style="display: none">
						<div id="Pagination"></div>
						<div class="searchPage">
							<span class="page-sum">共<strong class="allPage">0</strong>页</span>
							<span class="page-go">跳转<input type="text">页</span>
							<a href="javascript:;" class="page-btn">确定</a>
						</div>
					</div>
				</div>
				<div class="videoBody-bottom-right">
					<p class="videoBody-bottom-right-title">正在学习的小伙伴们</p>
				<div class="haveNull"><img src="/mhome/img/nullSchool.png"><p>还没有小伙伴来学习哦~~</p></div></div>
			</div>
		</div>

		<div class="nopurchase videomodal1 hide">
			<p class="nopurchase-close"><img src="/mhome/img/detail_close.png"></p>
			<img class="ku" src="/mhome/img/free_video_icon50.png" alt="">
			<p class="nopurchase-title">亲爱的小伙伴，试学课程已经结束啦</p>
			<p class="nopurchase-body">想获取更多优质内容，结交更多技术牛人，请购买该课程</p>
			<span class="buy">立即购买</span>
		</div>
		<div class="nopurchase videomodal2 hide">
			<p class="nopurchase-close"><img src="/mhome/img/detail_close.png"></p>
			<img class="ku" src="/mhome/img/finish54.png" alt="">
			<p class="nopurchase-title">恭喜你顺利完成该课时的学习，继续加油吧~</p>
			<span class="nextSchool">学习下一课时</span>
		</div>
		<div class="nopurchase videomodal3 hide">
			<p class="nopurchase-close"><img src="/mhome/img/detail_close.png"></p>
			<img class="ku" src="/mhome/img/finish54.png" alt="">
			<p class="nopurchase-title">恭喜你顺利完成该课时的学习，继续加油吧~</p>
			<span class="goup">返回列表</span>
		</div>
		<div class="backgrounds1 hide"></div>
		<div class="backgrounds2 hide"></div>
		<div class="censorship">
			<div class="censorshipBox clearfix">
				<i class="iconfont icon-guanbi censorship-close"></i>
				<div class="censorship-top">
					<i class="iconfont icon-xiaolian"></i>
					<div class="success-hint">恭喜你已经完成当前阶段学习任务。通过关卡任务检测下学习结果吧！</div>
				</div>
				<div class="censorship-middle">
					<span class="s1">关卡任务：<em>完成简单小程序任务</em></span>
					<span class="s2">总分数/通关分数：<em>100/80</em>分</span>
					<span class="s3">考试时长：<em>40</em>分钟</span>
					<span class="s4">试题数量：<em>20</em>道</span>
				</div>
				<div class="censorship-bottom">
					<div class="chuangguan">闯关</div>
					<div class="friendly-hint"><span class="xing">*</span><span>注：通过关卡后，才能学习下一阶段视频</span></div>
				</div>
			</div>
		</div>
		<div class="censorshipSuccess">
			<div class="censorship-successBox clearfix">
				<i class="iconfont icon-guanbi censorship-close"></i>
				<div class="censorship-top">
					<i class="iconfont icon-dawancheng"></i>
					<div class="success-hint">恭喜你已通过本次闯关任务！</div>
				</div>
				<div class="censorship-middle">
					<span class="s1">关卡任务：<em>完成简单小程序任务</em></span>
					<span class="s2">总分数/通关分数：<em>100/80</em>分</span>
					<span class="s5">得分：<em>85</em><i style="color: #ff4012;">分</i></span>
					<span class="s3">有<em class="e1">15</em>人已通关，当前排名第<em class="e2">5</em>名</span>
					<span class="s4">实际用时：<em class="e1">03：42</em></span>
				</div>
				<div class="censorship-bottom">
					<div class="watchShijuan">查看试卷</div>
					<div class="continueLearn">继续学习</div>
					<div class="friendly-hint"><span class="xing">*</span><span>注：通过关卡后，才能学习下一阶段视频</span></div>
				</div>
			</div>
		</div>
		<div class="censorshipFail">
			<div class="censorship-failBox clearfix">
				<i class="iconfont icon-guanbi censorship-close"></i>
				<div class="censorship-top">
					<i class="iconfont icon-ku cnesorshipku"></i>
					<div class="success-hint">当前关卡任务未能通过！复习一下，查缺补漏，定能过关斩将！</div>
				</div>
				<div class="censorship-middle">
					<span class="s1">关卡任务：<em>完成简单小程序任务</em></span>
					<span class="s2">总分数/通关分数：<em>100/80</em>分</span>
					<span class="s5">得分：<em>85</em><i style="color: #ff4012;">分</i></span>
					<span class="s4">实际用时：<em class="e1">03：42</em></span>
				</div>
				<div class="censorship-bottom">
					<div class="look">查看试卷</div>
					<div class="tryAgain">再试一次</div>
					<div class="friendly-hint"><span class="xing">*</span><span>注：通过关卡后，才能学习下一阶段视频</span></div>
				</div>
			</div>
		</div>
		<!--------稍后重试---------->
		<div class="waitingTry">
			<div class="tryContent">
				<div style="position: relative;width: 100%;height: 100%;">
					<i class="iconfont icon-guanbi try-close"></i>
					<i class="iconfont icon-weijiaojuan try-wei"></i>
					<p>关卡任务尚未完成，可以尝试重新闯关</p>
					<span>好的</span>
				</div>
			</div>
		</div>
		<!--------遮盖-------->
		<div class="passThrough">
			<div class="passContent">
				<p>正在奋力闯关中...</p>
				<span>好的，已完成</span>
			</div>
		</div>
	
	<script src="/mhome/js/video.js" charset="utf-8"></script>
	<script src="/mhome/js/footer.js"></script><div class="footerDT"><footer><div class="content"><div class="content-item footer-bodys"><div class="content-item content-footer-link about-us"><ul class="gate"><li data-id="first" data-url="../html/aboutUs.html">关于我们<span>|</span></li><li data-id="two" data-url="../html/aboutUs.html">人才招聘<span>|</span></li><li data-id="three" data-url="../html/aboutUs.html">联系我们<span>|</span></li><li data-id="four" data-url="../html/aboutUs.html" class="noline">常见问题</li></ul></div><div class="trademark">京ICP备08001421号 京公网安备110108007702 Copyright @ 2016 博学谷 All Rights Reserved<span style="margin-right:5px;"></span><span id="cnzz_stat_icon_1260713417"><a href="http://www.cnzz.com/stat/website.php?web_id=1260713417" target="_blank" title="站长统计"><img border="0" hspace="0" vspace="0" src="/mhome/img/pic1.gif"></a></span></div></div></div></footer></div><script src="/css/z_stat.php"></script><script src="/css/core.php" charset="utf-8"></script>
	<script src="/mhome/js/jquery.placeholder.min.js"></script>
	<script>
		$(function() {
			$('input,textarea').placeholder();
			$("body").append('<div class="modal" id="login" data-backdrop="static">' +
				'<div class="modal-dialog login-module" role="document">' +
				'<div class="cymylogin" style="height: 410px!important;">' +
				'<div class="cymylogin-top clearfix">' +
				'<div class="cymyloginlogo">欢迎登录&nbsp;&nbsp;博学谷云课堂</div>' +
				'<div class="cymyloginhint cymlogin">' +
				'</div></div>' + '<div class="cymylogin-bottom form-login">' +
				'<input type="text" class="cyinput1 form-control" autocomplete="off" maxlength="30" placeholder="请输入手机号或邮箱"/>' +
				'<div class="cymyloginclose1"></div>' +
				'<input type="password" class="cyinput2 form-control" maxlength="18" placeholder="请输入6-18位密码"/>' +
				'<div class="cymyloginclose2"></div>' +
				'<button class="cymyloginbutton">登<em></em>录</button>' +
				'<div class="cymyloginpassword">' +
				'<a class="atOnceRegister" href="/web/html/login.html?ways=register">立即注册</a>' +
				'<a class="atOnceResetPassword" href="/web/html/resetPassword.html">忘记密码?</a>' +
				'</div>' +
				'</div></div></div></div>');
			//登陆
			var flag = false;

			function errorMessage(info) {
				flag = false;
				var errorReg = /[a-zA-z]+/g;
				if(errorReg.test(info)) {
					layer.alert("系统繁忙，请稍候再试!", {
						icon: 2
					});
					return flag = true;
				}
			}
			/*按回车键进行登录*/
			$(".cymylogin .cyinput2,.cymylogin .cyinput1").unbind("keyup").bind("keyup", function(evt) {
				if(evt.keyCode == "13") {
					$(".cymylogin .cymyloginbutton").trigger("click");
				}
			});
			var cymyLogin = document.getElementsByClassName("cymlogin")[0];
			initLogin();
			/*按回车键进行登录*/
			$(".cymylogin .cyinput2,.cymylogin .cyinput1").unbind("keyup").bind("keyup", function(evt) {
				if(evt.keyCode == "13") {
					$(".cymylogin .cymyloginbutton").trigger("click");
				}
			});
			$(".form-login .cymyloginclose1").on("click", function() {
				$(".cymyloginclose1").css("display", "none");
				$(".cyinput1").css({
					"border": "1px solid #2cb82c"
				});
				$(".cyinput1").val("");
			})
			$(".form-login .cymyloginclose2").on("click", function() {
				$(".cymyloginclose2").css("display", "none");
				$(".cyinput2").css({
					"border": "1px solid #2cb82c"
				});
				$(".cyinput2").val("");
			})
			$(".cyinput1").on("input", function() {
				var val = $(this).val();
				if(val == "") {
					$(".cymyloginclose1").css("display", "none");
				} else {
					$(".cymyloginclose1").css("display", "block");
				}
				return false;
			});
			$(".cyinput2").on("input", function() {
				var logPass = $(this).val();
				if(logPass == "") {
					$(".cymyloginclose2").css("display", "none");
				} else {
					$(".cymyloginclose2").css("display", "block");
				}
				return false;
			});

			function initLogin() {
				//清空登录
				var cymyLogin = document.getElementsByClassName("cymlogin")[0];
				$("#login").on('shown.bs.modal', function(e) {
					$(".cymylogin-bottom input").removeAttr("style");
					cymyLogin.style.display = "none";
				});
				RequestService("/online/user/isAlive", "GET", null, function(data) { ///online/user/isAlive
					if(data.success === true) {
						var path;
						localStorage.username = data.loginName;
						//头像预览
						if(data.resultObject.smallHeadPhoto != "img/defaultHeadImg.jpg") {
							path = data.resultObject.smallHeadPhoto;
						} else {
							path = bath + data.resultObject.smallHeadPhoto
						}
						$(".userPic").css({
							background: "url(" + path + ") no-repeat",
							backgroundSize: "100% 100%"
						});
						$('#login').css("display", "none");
						$(".loginGroup .logout").css("display", "none");
						$(".loginGroup .login").css("display", "block");
						$(".dropdown .name").text(data.resultObject.name).attr("title", data.resultObject.name);
					} else {
						$('#login').modal('show');
						$(".loginGroup .logout").css("display", "block");
						$(".loginGroup .login").css("display", "none");
					}
				});
				var isCliclLogin = false;

				$(".form-login .cyinput1").on("blur", function() {
					var cymyLogin = document.getElementsByClassName("cymlogin")[0];
					var regPhone = /^1[3-578]\d{9}$/;
					var regEmail = /^\w+([-+.]\w+)*@\w+([-.]\w{2,})*\.\w{2,}([-.]\w{2,})*$/;
					if($(".form-login .cyinput1").val().trim().length === 0) {
						$(".cyinput1").css("border", "1px solid #ff4012");
						cymyLogin.innerText = "请输入手机号或邮箱";
						cymyLogin.style.top = "154px";
						cymyLogin.style.display = "block";
					} else if($(".form-login .cyinput1").val().trim().indexOf("@") == "-1" && !(regPhone.test($(".form-login .cyinput1").val().trim()))) {
						$(".cyinput1").css("border", "1px solid #ff4012");
						cymyLogin.innerText = "手机号格式不正确!";
						cymyLogin.style.top = "154px";
						cymyLogin.style.display = "block";
					} else if($(".form-login .cyinput1").val().trim().indexOf("@") != "-1" && !(regEmail.test($(".form-login .cyinput1").val().trim()))) {
						$(".cyinput1").css("border", "1px solid #ff4012");
						cymyLogin.innerText = "邮箱格式不正确!";
						cymyLogin.style.top = "154px";
						cymyLogin.style.display = "block";
					} else {
						$(".cyinput1").css("border", "");
					}
				});
				$(".form-login .cyinput1").on("focus", function() {
					if(cymyLogin.innerText == "请输入手机号或邮箱" || cymyLogin.innerText == "手机号格式不正确!" || cymyLogin.innerText == "邮箱格式不正确!" || cymyLogin.innerText == "用户名或密码不正确!") {
						cymyLogin.style.display = "none";
					}
					$(".cyinput1").css("border", "1px solid #2cb82c");
				});
				$(".form-login .cyinput2").focus(function() {
					if(cymyLogin.innerText == "请输入6-18位密码") {
						cymyLogin.style.display = "none";
					}
					$(".cyinput2").css("border", "1px solid #2cb82c");
				});
				$(".form-login .cyinput2").blur(function() {
					var cymyLogin = document.getElementsByClassName("cymlogin")[0];
					var cyinput2Length = $(".form-login .cyinput2").val().trim().length;
					if(cyinput2Length == 0) {
						$(".cyinput2").css("border", "1px solid #ff4012");
						$(".cymlogin").css("top", "221px");
						cymyLogin.innerText = "请输入6-18位密码";
						cymyLogin.style.display = "block";
					} else if(cyinput2Length < 6 && cyinput2Length > 18) {
						$(".cyinput2").css("border", "1px solid #ff4012");
						$(".cymlogin").css("top", "221px");
						cymyLogin.innerText = "请输入6-18位密码";
						cymyLogin.style.display = "block";
					} else {
						$(".cyinput2").css("border", "")
					}
				});
				$(".form-login .cymyloginbutton").on("click", function(evt) { //登录验证
					var regPhone = /^1[3-578]\d{9}$/;
					var regEmail = /^\w+([-+.]\w+)*@\w+([-.]\w{2,})*\.\w{2,}([-.]\w{2,})*$/;
					var passwordReg = /^(?!\s+)[\w\W]{6,18}$/; //密码格式验证
					$(".cyinput1").css("border", "");
					$(".cyinput2").css("border", "");
					var data = {
						username: $(".form-login .cyinput1").val().trim(),
						password: $(".form-login .cyinput2").val()
					};
					if(data.username.length === 0) {
						$(".cyinput1").css("border", "1px solid #ff4012");
						cymyLogin.innerText = "请输入手机号或邮箱";
						cymyLogin.style.top = "154px";
						cymyLogin.style.display = "block";
						return;
					} else if(data.username.indexOf("@") == "-1" && !(regPhone.test(data.username))) {
						$(".cyinput1").css("border", "1px solid #ff4012");
						cymyLogin.innerText = "手机号格式不正确!";
						cymyLogin.style.top = "154px";
						cymyLogin.style.display = "block";
						return;
					} else if(data.username.indexOf("@") != "-1" && !(regEmail.test(data.username))) {
						$(".cyinput1").css("border", "1px solid #ff4012");
						cymyLogin.innerText = "邮箱格式不正确!";
						cymyLogin.style.top = "154px";
						cymyLogin.style.display = "block";
						return;
					} else if(data.password.length === 0) {
						$(".cyinput2").css("border", "1px solid #ff4012").val("");
						$(".cymlogin").css("top", "221px");
						cymyLogin.innerText = "请输入6-18位密码";
						cymyLogin.style.display = "block";
						return;
					}
					isCliclLogin = true;
					login(data);
				});

				function login(data, autoLogin) {
					RequestService("/online/user/login", "POST", data, function(result) { //登陆/index.html   /online/user/login
						if(result.success === true || result.success == undefined) {
							window.localStorage.userName = data.username;
							window.location.reload();
						} else { //登陆错误提示
							$(".loginGroup .logout").css("display", "block");
							errorMessage(result.errorMessage);
							if(!flag) {
								if(result.errorMessage == "用户名密码错误！") {
									cymyLogin.innerText = "用户名或密码不正确!";
									$(".cymlogin").css("top", " 154px");
									cymyLogin.style.display = "block";
								} else {
									cymyLogin.innerText = result.errorMessage;
									$(".cymlogin").css("top", " 154px");
									cymyLogin.style.display = "block";
								}
							}

						}
					});
				}
				$(".dropdown-menu li a").click(function(evt) {
					$(".top-item").removeClass("selected");
					var btn = $(evt.target);
					var id = "personcenter";
					var personcenterSt = window.localStorage.personcenter;
					window.localStorage.personcenter = $(evt.target).attr("data-id");
					if(window.location.pathname == "/web/html/personcenter.html") {
						if($(this).attr("data")) {
							RequestService("/online/user/logout", "GET", {}, function(data) {
								location.href = "/index.html";
								$(".loginGroup .logout").css("display", "block");
								$(".loginGroup .login").css("display", "none");
							});
						} else {
							$(".left-nav ." + window.localStorage.personcenter).click();
						}
					} else {
						if($(this).attr("data")) {
							RequestService("/online/user/logout", "GET", {}, function(data) {
								location.href = "/index.html";
								$(".loginGroup .logout").css("display", "block");
								$(".loginGroup .login").css("display", "none");
							});
						} else {
							var pathS = window.location.href;
							location.href = "/web/html/personcenter.html";
							RequestService("/online/user/isAlive", "GET", null, function(data) { ///online/user/isAlive
								if(data.success) {
									if(data.resultObject.smallHeadPhoto != "img/defaultHeadImg.jpg") {
										path = data.resultObject.smallHeadPhoto;
									} else {
										path = bath + data.resultObject.smallHeadPhoto
									}
									//头像预览
									$(".userPic").css({
										background: "url(" + path + ") no-repeat",
										backgroundSize: "100% 100%"
									});
									$('#login').modal('hide');
									$("html").css({
										"overflow-x": "hidden",
										"overflow-y": "auto"
									});
									$(".loginGroup .logout").hide();
									$(".loginGroup .login").show();
									$(".dropdown .name").text(data.resultObject.name).attr("title", data.resultObject.name);
									localStorage.username = data.resultObject.loginName;
									localStorage.userid = data.resultObject.id;
									if($(btn.parent().hasClass('selected'))) {

									} else {
										hideHtml();
									}
								} else {
									var pathS = window.location.href;
									location.href = "/index.html";
									localStorage.username = null;
									localStorage.password = null;
									$(".login").css("display", "none");
									$(".logout").css("display", "block");
									//                          }
								}
							});
						}
					}

				});
			}
		});
	</script>
	<script>
		function get_cc_verification_code(video_id) {
			var verificationcode;
			$.ajax({
				url: '/online/vedio/getCcVerificationCode',
				type: 'POST',
				async: false,
				data: {
					video_id: video_id,
					id: $.getUrlParam("vId")
				},
				success: function(data) {
					if(data.success) {
						verificationcode = data.resultObject.verificationcode;
					} else {
//						alert(data.errorMessage)
						if(data.errorMessage == "请登陆！") {
							$('#login').modal('show');
						}
					}
				}
			});
			return verificationcode;
		};
		$.getUrlParam = function(name) {
			var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
			var r = window.location.search.substr(1).match(reg);
			if(r != null) return unescape(r[2]);
			return null;
		};
		
		//验证不通过的回调
		function onlinePlayCallbak(video_id) {
			//弹出我们自己的提示框
//						$(".videomodal1").removeClass("hide");
//						$(".backgrounds1").removeClass("hide");
//			window.location.href="/web/html/payCourseDetailPage.html?id="+$.getUrlParam("courseId")+"&courseType=1&free=0";
		};
		//播放失败
//		function on_player_playerror(video_id){
//			alert(1)
//			alert(code)
//		};
		function on_spark_player_start(video_id) {
			RequestService("/video/updateStudyStatus", "POST", {
				studyStatus: 2,
				videoId: $.getUrlParam("vId")
			}, function(data) {
				console.log(data);
			});
		};

		function on_spark_player_stop(video_id) {
			RequestService("/video/updateStudyStatus", "POST", {
				studyStatus: 1,
				videoId: $.getUrlParam("vId")
			}, function(data) {
				console.log(data);
			});
			if($(".freeTable-list .hoverBorder").next().length == 0 && $(".freeTable-list .hoverBorder").parent().next().length == 0) {
				$(".videomodal3").removeClass("hide");
				$(".backgrounds2").removeClass("hide");
			} else {
				$(".videomodal2").removeClass("hide");
				$(".backgrounds2").removeClass("hide");
			}
		}

		function countChar(textareaName, spanName) {
			var num = 200 - $(".textStatus").val().length;
			if(num >= 0) {
				$("#textCounter").html(num);
			} else {
				$("#textCounter").html(0);
			}
		}
		//去掉Loding
		function on_spark_player_ready() {
			$(".loadImg").css("display", "none");
			$(".shadowJiaZai").css("display", "none");
		}
	</script>


<script src="/mhome/js/placeHolder.js"></script>
<script>
	$(function() {
		$('input').placeholder();
	});
</script><div class="modal" id="login" data-backdrop="static" style="display: none;"><div class="modal-dialog login-module" role="document"><div class="cymylogin" style="height: 410px!important;"><div class="cymylogin-top clearfix"><div class="cymyloginlogo">欢迎登录&nbsp;&nbsp;博学谷云课堂</div><div class="cymyloginhint cymlogin"></div></div><div class="cymylogin-bottom form-login"><input type="text" class="cyinput1 form-control" autocomplete="off" maxlength="30" placeholder="请输入手机号或邮箱"><div class="cymyloginclose1"></div><input type="password" class="cyinput2 form-control" maxlength="18" placeholder="请输入6-18位密码"><div class="cymyloginclose2"></div><button class="cymyloginbutton">登<em></em>录</button><div class="cymyloginpassword"><a class="atOnceRegister" href="https://www.boxuegu.com/web/html/login.html?ways=register">立即注册</a><a class="atOnceResetPassword" href="https://www.boxuegu.com/web/html/resetPassword.html">忘记密码?</a></div></div></div></div></div></body></html>
