@extends('backend.common.common')
@section('content')
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="course-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课程名称：</label>
			<div class="formControls col-xs-4 col-sm-6">{{ $liveInfo->course_name }}</div>
		</div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属专业：</label>
      <div class="formControls col-xs-4 col-sm-6">{{ $liveInfo->profession->profession_name }}</div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>授课老师：</label>
      <div class="formControls col-xs-4 col-sm-6">{{ $liveInfo->teacher->cnname }}</div>
    </div>      
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>直播时间：</label>
      <div class="formControls col-xs-4 col-sm-6">{{ $liveInfo->start_at }} 至 {{ $liveInfo->end_at }}</div>
    </div>
    @if($liveInfo->course_desc)
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">课程简介：</label>
      <div class="formControls col-xs-8 col-sm-6"><pre>{{ $liveInfo->course_desc }}</pre></div>
    </div>
    @endif
    @if($liveInfo->cover)
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">封面图：</label>
      <div class="formControls col-xs-8 col-sm-9"><img src="{{config('program.url')}}/{{ $liveInfo->cover }}" height="150" width="150"></div>
    </div>
    @endif
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">推流地址：</label>
      <div class="formControls col-xs-8 col-sm-9">{{ $push_address }}</div>
    </div> 
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3">观看地址：</label>
      <div class="formControls col-xs-8 col-sm-9">{{ $pull_address }}</div>
    </div>        
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
        <span class="btn btn-warning radius send_sms" data-live-id="{{ $liveInfo->id }}">发送短信通知主播老师</span>
				<span class="btn btn-primary radius send_mail" data-live-id="{{ $liveInfo->id }}">发送邮件通知主播老师</span>
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

    // 发送邮件的ajax方法
  function  send_Mail(live_id) {
      $.ajax({
          type:'get',
          dataType:'json',
          url:'{{url("System/Live/SendMail")}}/'+live_id,
          success:function (json) {
                if(json.status){
                    // 发送成功！
                    layer.msg(json.message,{'icon':1,'time':2000});
                }else{
                    // 发送失败！
                    layer.msg(json.message,{'icon':2,'time':2000});
          }
      }
  });
  }

$(function(){
  // 点击发送邮件
  $(document).on('click','.send_mail',function(){
    var live_id = $(this).data('live-id');
    var url = "/System/Live/SendMail/" + live_id;
    $.get(url,function(msg){
      if( msg.status ){
        // 发送成功！
        layer.msg(msg.message,{'icon':1,'time':2000});
      }else{
        // 发送失败！
        layer.msg(msg.message,{'icon':2,'time':2000});
      }
    },'json');
  });

  // 点击发送短信  
  $(document).on('click','.send_sms',function(){
    var live_id = $(this).data('live-id');
    var url = "/System/Live/SendSms/" + live_id;
    $.get(url,function(msg){
      if( msg.status ){
        // 发送成功！
        layer.msg(msg.message,{'icon':1,'time':2000});
      }else{
        // 发送失败！
        layer.msg(msg.message,{'icon':2,'time':2000});
      }
    },'json');
  });

});
</script>
@endsection
