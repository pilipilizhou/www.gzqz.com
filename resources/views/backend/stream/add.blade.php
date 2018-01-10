@extends('backend.common.common')
@section('content')
<article class="page-container">
	<form action="{{ url('/System/Stream/Store') }}" method="post" class="form form-horizontal" id="form-admin-role-add">
		{{ csrf_field() }}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>流名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" id="stream_name" name="stream_name">
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
{{-- jQuery.validation验证插件 --}}
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script>
$(function(){

	$("#form-admin-role-add").validate({
		rules:{
			stream_name:{
				required:true,
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
