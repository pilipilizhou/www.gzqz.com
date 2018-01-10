@extends('backend.common.common')
@section('content')

<!-- 首页需要引入hui-admin中的webuploader的css定义  -->
<link rel="stylesheet" href="/admin/lib/webuploader/0.1.5/webuploader.css">


<article class="page-container">
	<form class="form form-horizontal" id="form-admin-store-add" action="{{ url('System/Permission/Save')}}/{{$permission->ps_id }}" method="post">
	{{csrf_field()}}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限ID：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{$permission->ps_id}}" placeholder="" disabled=""  id="ps_id" name="ps_id">
		</div>
	</div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" value="{{$permission->ps_name}}" placeholder="" id="ps_name" name="ps_name">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上级权限：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text"value="{{$permission->ps_pid}}" placeholder="" id="ps_pid" name="ps_pid">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>控制器：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" value="{{$permission->ps_c}}" placeholder="" id="ps_c" name="ps_c">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>操作方法：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" value="{{$permission->ps_a}}" placeholder="" id="ps_a" name="ps_a">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>路由地址：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" value="{{$permission->address}}" placeholder="" id="address" name="address">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限等级：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" value="{{$permission->ps_level}}" placeholder="" id="ps_level" name="ps_level">
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
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
    $(function(){

      

        $("#form-admin-store-add").validate({
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
<!--/请在上方写此页面业务相关的脚本-->
@endsection
