@extends('backend.common.common')
@section('content')
    {{-- webuploader插件 --}}
    <link rel="stylesheet" href="/admin/lib/webuploader/0.1.5/webuploader.css">
    <link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />

    <article class="page-container">
        <form action="{{ url('System/Professional/Save') }}/{{$profession->id}}" method="post" class="form form-horizontal" id="form-admin-store-add">
            {{ csrf_field() }}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>专业名称：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <input type="text" class="input-text" name="profession_name" id="profession_name" value="{{$profession->profession_name}}">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属学科：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <select name="subject_id" id="subject_id">

                        @foreach( $subjects as $subject )
                            @if($profession->subject_id == $subject['id'])
                                <option value="{{$subject['id']}}">{{$subject['subject_name']}}</option>
                            @endif
                        @endforeach
                        @foreach( $subjects as $subject )
                            @if($profession->subject_id != $subject['id'])
                                <option value="{{$subject['id']}}">{{$subject['subject_name']}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">专业简介：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <textarea name="profession_desc" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true">
                        {{$profession->profession_desc}}
                    </textarea>
                    <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>价格：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <input type="text" class="input-text" name="price" value="{{$profession->price}}" id="price">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>优惠价：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <input type="text" class="input-text" value="{{$profession->sale_price}}" name="sale_price" id="sale_price" placeholder="实际价格=价格-优惠">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>专业时长(单位：小时)：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <input type="text" class="input-text" name="duration" value="{{$profession->duration}}" id="duration">
                </div>
            </div>


            <!--
            这里是webuploader上传插件的布局,这完全有赖于你的前端布局技术
            由于我是非前端科班出身的,布局得比较一般
            -->
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><br /><br />封面图片：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <!-- 保存上传成功以后的图片地址 -->
                    <input type="hidden" name="cover" value="{{$profession->cover}}">
                    <!-- 定义一个标签用来存放图片的预览图 -->
                    <div id="webuploader-img" style="margin-bottom: 1px;">
                        @if($profession->cover)
                            <img src="{{config('program.url')}}/{{$profession->cover}}" style="width:150px;height: 90px;">
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
                        <span id="progressed">上传完成0%</span>
                    </div>
                    <!-- 选择图片的按钮 -->
                    <div id="webuploader-btn">选择文件</div>
                    <div class="btn btn-primary radius" id="webuploder-start">上传文件</div>
                </div>
            </div>


            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>有效时间(单位：天)：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <input type="text" class="input-text" name="expire_at" value="{{$profession->expire_at}}" id="expire_at">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>点击量：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <input type="text" class="input-text" name="click" value="{{$profession->click}}" id="click">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>学习人数：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <input type="text" class="input-text" name="number" value="{{$profession->number}}" id="number">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否推荐专业：</label>
                <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                    <div class="radio-box">
                        @if($profession->is_recommend == 1)
                           <input name="is_recommend" type="radio" value="1" id="recommend-1" checked>
                        @else
                           <input name="is_recommend" type="radio" value="1" id="recommend-1" >
                        @endif
                        <label for="recommend-1">是</label>
                    </div>
                    <div class="radio-box">

                        @if($profession->is_recommend == 0)
                            <input type="radio" id="recommend-2" value="0" name="is_recommend" checked>
                        @else
                            <input type="radio" id="recommend-2" value="0" name="is_recommend">
                        @endif
                        <label for="recommend-2">否</label>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否精品专业：</label>
                <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                    <div class="radio-box">
                        @if($profession->is_best == 1)
                            <input name="is_best" type="radio" value="1" id="best-1" checked>
                        @else
                            <input name="is_best" type="radio" value="1" id="best-1" >
                        @endif

                        <label for="best-1">是</label>
                    </div>
                    <div class="radio-box">
                        @if($profession->is_best == 0)
                            <input type="radio" id="best-2" value="0" name="is_best" checked>
                        @else
                            <input type="radio" id="best-2" value="0" name="is_best">
                        @endif
                        <label for="best-2">否</label>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否热门专业：</label>
                <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                    <div class="radio-box">
                        @if($profession->is_hot == 1)
                            <input name="is_hot" type="radio" value="1" id="hot-1" checked>
                        @else
                            <input name="is_hot" type="radio" value="1" id="hot-1" >
                        @endif
                        <label for="hot-1">是</label>
                    </div>
                    <div class="radio-box">
                        @if($profession->is_hot == 0)
                            <input type="radio" id="hot-2" value="0" name="is_hot" checked>
                        @else
                            <input type="radio" id="hot-2" value="0" name="is_hot">
                        @endif

                        <label for="best-2">否</label>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>排序：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <input type="text" class="input-text" value="{{$profession->sort}}"  name="sort" id="sort" placeholder="数值越大，越靠前！">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课程详情：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <textarea name="content" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true">
                        {{$profession->content}}
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
    <!--_footer 作为公共模版分离出去-->
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
    <script type="text/javascript">
        $(function(){

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
                    $preview.html('<img src="/home/uploader.jpg" style="width:150px;height: 90px;filter: grayscale(100%);">');
                }
            });

            $("#form-admin-store-add").validate({
                rules:{
                    profession_name:{
                        required:true,
                    },
                    price:{
                        required:true
                    },
                    sale_price:{
                        required:true
                    },
                    expire_at:{
                        required:true,
                        digits:true
                    },
                    click:{
                        required:true,
                        digits:true
                    },
                    number:{
                        required:true,
                        digits:true
                    },
                    sort:{
                        required:true,
                        digits:true
                    },
                    content:{
                        required:true,
                    }
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
