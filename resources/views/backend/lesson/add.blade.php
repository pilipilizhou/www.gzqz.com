@extends('backend.common.common')
@section('content')
{{-- webuploader插件 --}}
<link rel="stylesheet" href="/admin/lib/webuploader/0.1.5/webuploader.css">
<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<article class="page-container">
	<form action="{{ url('/System/Lesson/Store') }}" method="post" class="form form-horizontal" id="lesson-add">
		{{ csrf_field() }}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课时标题：</label>
			<div class="formControls col-xs-4 col-sm-6">
				<input type="text" class="input-text" name="lesson_name" id="lesson_name">
			</div>
		</div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属课程：</label>
      <div class="formControls col-xs-4 col-sm-6">
        <span class="select-box">
          <select class="select" name="course_id" id="course_id">
                  @foreach( $courses as $course )
                    <option value="{{$course['id']}}">{{$course['course_name']}}</option>
                  @endforeach
          </select>
        </span>
      </div>
    </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">封面图：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<!-- 保存上传成功以后的图片地址 -->
				<input type="hidden" name="cover" value="">
        <!-- 定义一个标签用来存放图片的预览图 -->
        <div id="webuploader-img" style="margin-bottom: 5px;">
                <img src="/home/uploader.jpg" style="width:150px;height: 150px;filter: grayscale(100%);">
        </div>
        <!-- 上传进度条 -->
        <div id="processing">
            <div class="progress" style="width: 400px;margin-bottom: 5px;">
                <span class="progress-bar">
                    <span class="sr-only" style="width:0%"></span>
                </span>
            </div>
            <span id="progressed">0%</span>
        </div>
        <!-- 选择图片的按钮 -->
				<div id="webuploader-btn">选择文件</div>
				<div class="btn btn-primary radius" id="webuploder-start">上传文件</div>
			</div>
		</div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">课时视频：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <!-- 保存上传成功以后的图片地址 -->
        <input type="hidden" name="video_address" value="">
        <!-- 定义一个标签用来存放图片的预览图 -->
        <div id="webuploader-video" style="margin-bottom: 5px;">
            视频上传无法显示预览缩略图
        </div>
        <!-- 上传进度条 -->
        <div id="processing-video">
            <div class="progress" style="width: 400px;margin-bottom: 5px;">
                <span class="progress-bar">
                    <span class="sr-only" style="width:0%"></span>
                </span>
            </div>
            <span id="progressed-video">0%</span>
        </div>
        <!-- 选择视频的按钮 -->
        <div id="webuploader-btn-video">选择文件</div>
        <div class="btn btn-primary radius" id="webuploder-start-video">上传文件</div>
      </div>
    </div>    
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">课时简介：</label>
      <div class="formControls col-xs-8 col-sm-6">
        <textarea name="lesson_desc" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true"></textarea>
        <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
      </div>
    </div>   

    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课时时长(单位：分钟)：</label>
      <div class="formControls col-xs-4 col-sm-6">
        <input type="text" class="input-text" name="duration" id="duration">
      </div>
    </div>    
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>排序：</label>
      <div class="formControls col-xs-4 col-sm-6">
        <input type="text" class="input-text" name="sort" id="sort" placeholder="数值越大，越靠前！">
      </div>
    </div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius"><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>
@endsection

@section('footer-js')
{{-- webuploader插件 --}}
<script src="/admin/lib/webuploader/0.1.5/webuploader.js"></script>
{{-- jQuery.validation验证插件 --}}
<script src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script>
$(function(){

  // 单选按钮的样式
  $('.skin-minimal input').iCheck({
    checkboxClass: 'icheckbox-blue',
    radioClass: 'iradio-blue',
    increaseArea: '20%'
  });

	// webuploader上传文件插件的配置代码
	var uploader = WebUploader.create({
		auto: false, // 是否开启自动上传
		// 绑定上传文件的点击按钮
		pick: "#webuploader-btn",
		// 上传文件处理程序的URL地址
		server: "{{url('System/Uploader/Upload')}}",
		// 上传文件时附带的表单信息
		formData: {
			  '_token': '{{ csrf_token() }}',
		},
		// 上传文件框的name值
		fileVal:'uploader',
		// 是否开启图片压缩上传[一般关闭]
		resize: false,
		// 限制上传文件的格式
		accept: {
		  extensions: 'gif,jpg,jpeg,png',
		},
	});

	// 生成上传文件预览[上传前预览]
	$preview = $('#webuploader-img');
	uploader.on('fileQueued', function(file) {
			// 生成预览图片效果
	    uploader.makeThumb(file, function(error, src) {
	        $preview.empty();
	        $('#processing .sr-only').css('width', '0%');
	        $('#progressed').html('0%');
	        if (error) {
	            layer.msg("不能预览图片。");
	            return;
	        }
	        $preview.html("<img src='" + src +"' />");
	    }, 150, 90);
	});


	// 显示上传文件的进度条  （监听的是上传到电脑临时文件夹的进度）
	uploader.on('uploadProgress', function(file, percentage) {
			// console.log(percentage);
	    $('#processing .sr-only').css('width', percentage * 100 + '%');
	    $('#progressed').html(percentage * 100 + '%');
	});

	// webuploder的点击上传
	$('#webuploder-start').on('click',function(){
		uploader.upload();
	});

	// 接收文件上传处理的结果
	uploader.on('uploadSuccess',function(file, msg){ // 参数2就是服务器返回的数据
		if( msg.status ){
			layer.msg('上传文件成功！',{icon:6,time:1500});
			$('input[name=cover]').val(msg.file);
		}else{
			layer.msg('上传文件失败！请重新上传',{icon:5,time:1500});
			uploader.reset();
      $('#processing .sr-only').css('width', '0%');
      $('#progressed').html('0%');
      $preview.empty();		
		}
	});


  // 视频上传
  // webuploader上传文件插件的配置代码
  var videoUploader = WebUploader.create({
    auto: false, // 是否开启自动上传
   
   
    // 绑定上传文件的点击按钮
    pick: "#webuploader-btn-video",
    // 上传文件处理程序的URL地址
    server: "{{url('System/Uploader/Upload')}}",
    // 上传文件时附带的表单信息
    formData: {
        '_token': '{{ csrf_token() }}',
    },
    // 上传文件框的name值
    fileVal:'uploader',
    // 是否开启图片压缩上传[一般关闭]
    resize: false,
    // 限制上传文件的格式
    accept: {
      extensions: 'mp4,avi',
    },
  });

  // 显示上传文件的进度条
  videoUploader.on('uploadProgress', function(file, percentage) {
      // console.log(percentage);
      $('#processing-video .sr-only').css('width', percentage * 100 + '%');
      $('#progressed-video').html(percentage * 100 + '%');
  });

  // webuploder的点击上传
  $('#webuploder-start-video').on('click',function(){
    videoUploader.upload();
  });

  // 接收文件上传处理的结果
  videoUploader.on('uploadSuccess',function(file, msg){ // 参数2就是服务器返回的数据
    if( msg.status ){
      layer.msg('上传文件成功！',{icon:6,time:1500});
      $('input[name=video_address]').val(msg.file);
    }else{
      layer.msg('上传文件失败！请重新上传',{icon:5,time:1500});
      videoUploader.reset();
      $('#processing-video .sr-only').css('width', '0%');
      $('#progressed-video').html('0%');  
    }
  });

	$("#lesson-add").validate({
		rules:{
            lesson_name:{
                required:true
            },
            duration:{
                required:true,
                digits:true
            },
            sort:{
                required:true,
                digits:true
            },
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){ // 表单提交
			$(form).ajaxSubmit(function(msg){
				if( msg.status ){
					// 关闭当前layer弹窗
					layer.msg(msg.message,{icon:6,time:2000},function(){
						// var index = parent.layer.getFrameIndex(window.name);
						// parent.layer.close(index);
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
@endsection
