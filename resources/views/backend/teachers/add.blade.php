@extends('backend.common.common')
@section('content')
<!-- 首页需要引入hui-admin中的webuploader的css定义  -->
<link rel="stylesheet" href="/admin/lib/webuploader/0.1.5/webuploader.css">
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add" action="{{ url('System/Teachers/Store') }}" method="post">
	{{csrf_field()}}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>老师账号：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="username" name="username">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>老师姓名：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="cnname" name="cnname">
		</div>
	</div>


		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><br /><br />老师头像：</label>
			<div class="formControls col-xs-8 col-sm-9">
				{{-- 保存上传成功以后的图片地址 --}}
				<input type="hidden" name="avatar" value="">
        {{-- 定义一个标签用来存放图片的预览图 --}}
        <div id="webuploader-img" style="margin-bottom: 1px;">
        	<img src="/home/uploader.jpg" style="width:150px;height: 150px;filter: grayscale(100%);">
        </div>
        {{-- 上传进度条 --}}
        <div id="processing">
            <div class="progress" style="width: 400px;margin-bottom: 5px;">
                <span class="progress-bar">
                    <span class="sr-only" style="width:0%"></span>
                </span>
            </div>
            <span id="progressed">上传完成0%</span>
        </div>
                {{-- 选择图片的按钮 --}}
				<div id="webuploader-btn">选择头像</div>
				<div class="btn btn-primary radius" id="webuploder-start">上传文件</div>
			</div>
		</div>




	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="sex" type="radio" id="sex-1" value="男" checked>
				<label for="sex-1">男</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="sex-2" name="sex" value="女">
				<label for="sex-2">女</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="mg_phone" name="phone">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" placeholder="@" name="email" id="email">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">备注：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<textarea name="remark" cols="" rows="" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true" onKeyUp="$.Huitextarealength(this,100)"></textarea>
			<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
		</div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
	</form>
</article>
@endsection


@section('footer-js')
{{-- webuploader插件 --}}
<script src="/admin/lib/webuploader/0.1.5/webuploader.js"></script>
<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});


    //创建一个webuploader对象
	var uploader = WebUploader.create({
		// 是否开启自动上传,不要自动上传,而是点击上传按钮时才传
         auto: false, 
         //把<div id="webuploader-btn">设置为选择按钮
         pick: '#webuploader-btn', 
         // 上传文件处理程序的URL地址
		server: "{{url('System/Uploader/Upload')}}",
		// 上传文件时附带的表单信息
		formData: {
			  '_token': '{{ csrf_token() }}',
		},
		//上传文件框的name值也就是设置<input type="file" name="uploader" />
		fileVal:'uploader',
		//是否开启图片压缩上传[一般关闭],压缩会导致图片失真
		resize: false,
		//设置允许上传的文件后缀
		accept: {
		  extensions: 'gif,jpg,jpeg,png',
		},		
	});

	//声明要预览图片的位置在哪里
	var preview = $('#webuploader-img');
	
	//触发上传事件'fileQueued',触发时会有一个闭包的回调函数发生
	uploader.on('fileQueued',function(file){
		//该方法用于生成预览图,为150x150像素
		uploader.makeThumb(file, function(error, src){
			//清空当前要显示预览图片对象中的内容
			preview.empty();
			//把上传进度重新初始化
		    $('#processing .sr-only').css('width', 0 );
	        $('#progressed').html('上传完成0%');
			//error是生成预览错误时的对象,如果没有错误,该error为null
			if(error){
				layer.alert("无法生成预览图片效果,请重新尝试!",{icon:5,time:3000});
				return;
			}
			//src是生成预览的图片来源地址
			preview.html("<img src='" + src +"' />");
		},150,150);
	});

	$("#webuploder-start").on('click',function(){
		uploader.upload();
	});

   //上传未完成,整个上传的进度都会被uploadProgress监听
	uploader.on('uploadProgress', function(file, percentage) {
	   $('#processing .sr-only').css('width', percentage * 100 + '%');
	   $('#progressed').html('上传完成' + percentage * 100 + '%');
	});

    // 接收文件上传处理的结果
	uploader.on('uploadSuccess',function(file, json){ 

		if( json.status ){
			//提示用户上传成功的信息
			layer.msg(json.message,{icon:6,time:1500});
			//把<input type='hidden' name='logo'>中的value设置json.file
			$('input[name=avatar]').val(json.file);
		}else{
			layer.msg('上传文件失败！请重新上传',{icon:5,time:1500});
			//uploader.reset()把webuploader对象重置为原始状态
			uploader.reset();
		    $('#processing .sr-only').css('width', '0%');
		    $('#progressed').html('上传完成:0%');
		    //上传失败,重置原始的上传预览图片
		    $preview.html('<img src="/home/uploader.jpg" style="width:150px;height: 150px;filter: grayscale(100%);">');		
		}
	});

	
	$("#form-admin-add").validate({
		rules:{
			/*
			adminName:{
				required:true,
				minlength:4,
				maxlength:16
			},
			password:{
				required:true,
			},
			password2:{
				required:true,
				equalTo: "#password"
			},
			sex:{
				required:true,
			},
			phone:{
				required:true,
				isPhone:true,
			},
			email:{
				required:true,
				email:true,
			},
			adminRole:{
				required:true,
			},*/
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit(function(msg){
				if( msg.status ){
					// 关闭当前layer弹窗
					layer.msg(msg.message,{icon:6,time:2000},function(){
						parent.location.reload(); // 父级页面刷新					
					});
				}else{
					// 提示错误
					layer.alert(msg.message,{icon:5,time:3000});
				}
			});

		}
	});
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
@endsection
