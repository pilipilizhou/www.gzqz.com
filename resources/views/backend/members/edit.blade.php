@extends('backend.common.common')
@section('content')
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add" action="{{ url('System/Members/Save') }}/{{$member_id}}" method="post">
	{{csrf_field()}}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>会员帐号：</label>
		<div class="formControls col-xs-8 col-sm-9">
			{{--把id和name属性去掉，免得提交--}}
			<input type="text" class="input-text"  value="{{$member->username}}" readonly="readonly"  placeholder="" STYLE="background: #ccc;border: 1px solid #ccc; color:#ebebeb;">
		</div>
	</div>
	{{--<div class="row cl">--}}
		{{--<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>初始密码：</label>--}}
		{{--<div class="formControls col-xs-8 col-sm-9">--}}
			{{--<input type="password" class="input-text" autocomplete="off" value="" placeholder="密码" id="password" name="password">--}}
		{{--</div>--}}
	{{--</div>--}}
	{{--<div class="row cl">--}}
		{{--<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>--}}
		{{--<div class="formControls col-xs-8 col-sm-9">--}}
			{{--<input type="password" class="input-text" autocomplete="off"  placeholder="确认新密码" id="password2" name="password2">--}}
		{{--</div>--}}
	{{--</div>--}}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>会员姓名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				{{--把id和name属性去掉，免得提交--}}
				<input type="text" class="input-text" value="{{$member->cnname}}" name="cnname"  placeholder="" >
			</div>
		</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">

				@if($member->sex=='男')
				<input name="sex" type="radio" id="sex-1" value="男" checked>
				@else
				<input name="sex" type="radio" id="sex-1" value="男" >
				@endif
				<label for="sex-1">男</label>
			</div>
			<div class="radio-box">
				@if($member->sex=='女')
				<input type="radio" id="sex-2" value="女" name="sex" checked>
				@else
				<input type="radio" id="sex-2" value="女" name="sex">
				@endif
				<label for="sex-2">女</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{$member->phone or ''}}" placeholder="" id="mg_phone" name="mg_phone">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>地址：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" placeholder="@" name="address" id="address" value="{{$member->address or ''}}">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">备注：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<textarea name="remark" cols="" rows="" class="textarea"   placeholder="说点什么...100个字符以内" dragonfly="true" onKeyUp="$.Huitextarealength(this,100)">{{$member->remark or ''}}</textarea>
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
	
	$("#form-admin-add").validate({
		rules:{
            cnname:{
				required:true
			},
            mg_phone:{
				required:true,
                digits:true
			},
            address:{
				required:true
			}
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
