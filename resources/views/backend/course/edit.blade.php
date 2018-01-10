@extends('backend.common.common')
@section('content')

	{{-- webuploader插件 --}}
	<link rel="stylesheet" href="/admin/lib/webuploader/0.1.5/webuploader.css">
	<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
	<article class="page-container">
		<form action="{{ url('System/Course/Save') }}/{{$course->id}}" method="post" class="form form-horizontal" id="course-save">
			{{ csrf_field() }}
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课程名称：</label>
				<div class="formControls col-xs-4 col-sm-6">
					<input type="text" class="input-text" name="course_name" value="{{$course->course_name}}" id="course_name">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属专业：</label>
				<div class="formControls col-xs-4 col-sm-6">
        <span class="select-box">
          <select class="select" name="profession_id" id="profession_id">
			    @foreach($pros as $profession)
					@if($course->profession_id == $profession->id)
					  <option value="{{$profession->id}}">{{$profession->profession_name}}</option>
					@endif
			    @endforeach
      			@foreach($pros as $profession)
						@if($course->profession_id != $profession->id)
							<option value="{{$profession->id}}">{{$profession->profession_name}}</option>
						@endif
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
			   @foreach($teachers as $teacher)
				  @if($course->teacher_id == $teacher->teacher_id)
					  <option value="{{$teacher->teacher_id}}">{{$teacher->cnname}}</option>
				  @endif
			   @endforeach
			   @foreach($teachers as $teacher)
				   @if($course->teacher_id != $teacher->teacher_id)
					   <option value="{{$teacher->teacher_id}}">{{$teacher->cnname}}</option>
				   @endif
			   @endforeach
          </select>
        </span>
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">课程简介：</label>
				<div class="formControls col-xs-8 col-sm-6">
					<textarea name="course_desc" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true">
						 {{$course->course_desc}}
					</textarea>
					<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>价格：</label>
				<div class="formControls col-xs-4 col-sm-6">
					<input type="text" class="input-text" name="price"  value="{{$course->price}}" id="price">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>优惠价：</label>
				<div class="formControls col-xs-4 col-sm-6">
					<input type="text" class="input-text" name="sale_price"  value="{{$course->sale_price}}" id="sale_price" placeholder="实际价格=价格-优惠">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课程时长(单位：小时)：</label>
				<div class="formControls col-xs-4 col-sm-6">
					<input type="text" class="input-text" name="duration"  value="{{$course->duration}}" id="duration">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">封面图：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<!-- 保存上传成功以后的图片地址 -->
					<input type="hidden" name="cover" value="{{$course ->cover}}">
					<!-- 定义一个标签用来存放图片的预览图 -->
					<div id="webuploader-img" style="margin-bottom: 1px;">

						@if($course->cover)
							<img src="{{config('program.url')}}/{{$course ->cover}}" style="width:150px;height: 90px;">
						@else
							<img src="/home/uploader.jpg" style="width:150px;height: 150px;filter: grayscale(100%);">
						@endif

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
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>有效时间(单位：天)：</label>
				<div class="formControls col-xs-4 col-sm-6">
					<input type="text" class="input-text" name="expire_at"  value="{{$course->expire_at}}" id="expire_at">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>点击量：</label>
				<div class="formControls col-xs-4 col-sm-6">
					<input type="text" class="input-text" name="click"  value="{{$course->click}}" id="click">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>学习人数：</label>
				<div class="formControls col-xs-4 col-sm-6">
					<input type="text" class="input-text" name="number"  value="{{$course->number}}" id="number">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>排序：</label>
				<div class="formControls col-xs-4 col-sm-6">
					<input type="text" class="input-text" name="sort" id="sort"  value="{{$course->sort}}" placeholder="数值越大，越靠前！">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>专业详情：</label>
				<div class="formControls col-xs-8 col-sm-6">
					<textarea name="content" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true">
						 {{$course->content}}
					</textarea>
					<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
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
                },150,90);
            });

            //点击上传按钮的时候,触发上传
            $('#webuploder-start').on('click',function(){
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
                    $('input[name=cover]').val(json.file);
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

            $("#course-save").validate({
                rules:{
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
