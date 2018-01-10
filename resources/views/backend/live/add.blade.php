@extends('backend.common.common')
@section('content')

{{-- webuploader插件 --}}
<link rel="stylesheet" href="/admin/lib/webuploader/0.1.5/webuploader.css">
<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
@include('UEditor::head')
<article class="page-container">
	<form action="{{ url('System/Live/Store') }}" method="post" class="form form-horizontal" id="live-add">
		{{ csrf_field() }}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课程名称：</label>
			<div class="formControls col-xs-4 col-sm-6">
				<input type="text" class="input-text" name="course_name" id="course_name">
			</div>
		</div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属专业：</label>
      <div class="formControls col-xs-4 col-sm-6">
        <span class="select-box">
          <select class="select" name="profession_id" id="profession_id">
            @foreach($professionList as $item)
            <option value="{{ $item->id }}">{{ $item->profession_name }}</option>
            @endforeach
          </select>
        </span>
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>授课老师：</label>
      <div class="formControls col-xs-4 col-sm-6">
        <span class="select-box">
          <select class="select" name="teacher_id" id="teacher_id">
            @foreach($teacherList as $item)
            <option value="{{ $item->teacher_id }}">{{ $item->cnname }}</option>
            @endforeach
          </select>
        </span>
      </div>
    </div>  
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>直播流：</label>
      <div class="formControls col-xs-4 col-sm-6">
        <span class="select-box">
          <select class="select" name="stream_id" id="stream_id">
            @foreach($streamList as $item)
            <option value="{{ $item->id }}">{{ $item->stream_name }}</option>
            @endforeach
          </select>
        </span>
      </div>
    </div>        
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>直播开始时间：</label>
      <div class="formControls col-xs-4 col-sm-6">
        <input type="datetime-local" class="input-text" name="start_at" id="start_at">
      </div>
    </div>    
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>直播结束时间：</label>
      <div class="formControls col-xs-4 col-sm-6">
        <input type="datetime-local" class="input-text" name="end_at" id="end_at">
      </div>
    </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">课程简介：</label>
            <div class="formControls col-xs-8 col-sm-6">
                <script id="course_desc" name="course_desc" type="text/plain"  style="width:540px;height:260px;"></script>
            </div>
        </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">封面图：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <!-- 保存上传成功以后的图片地址 -->
        <input type="hidden" name="cover" value="">
        <!-- 定义一个标签用来存放图片的预览图 -->
        <div id="webuploader-img" style="margin-bottom: 5px;"></div>
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
<script type="text/javascript">
    //var ue = UE.getEditor('container');
    var ue = UE.getEditor('course_desc',{toolbars: [[
        'fullscreen', 'source', '|', 'undo', 'redo', '|',
        'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc'
    ]]});
    ue.ready(function() {
        //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
    });


</script>
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
		// flash上传文件的组件[兼容低版本浏览器]
		swf: "/admin/lib/webuploader/0.1.5/Uploader.swf",
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
	    }, 100, 100);
	});


	// 显示上传文件的进度条
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


	$("#live-add").validate({
		rules:{
			// profession_name:{
			// 	required:true,
			// },
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
