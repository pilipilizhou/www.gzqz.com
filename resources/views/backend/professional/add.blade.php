@extends('backend.common.common')
@section('content')
    {{-- webuploader插件 --}}
    <link rel="stylesheet" href="/admin/lib/webuploader/0.1.5/webuploader.css">
    <link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />

    {{-- zyupload插件的css样式，但hui-ui其实没有把这个样式调得非常完美 --}}
    <link rel="stylesheet" href="/admin/lib/zyUpload/control/css/zyUpload.css">

    <article class="page-container">
        <form action="{{ url('System/Professional/Store') }}" method="post" class="form form-horizontal" id="form-admin-store-add">
            {{ csrf_field() }}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>专业名称：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <input type="text" class="input-text" name="profession_name" id="profession_name">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属学科：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <select name="subject_id" id="subject_id">
                        @foreach( $subjects as $subject )
                            <option value="{{$subject['id']}}">{{$subject['subject_name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">专业简介：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <textarea name="profession_desc" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true"></textarea>
                    <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>价格：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <input type="text" class="input-text" name="price" id="price">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>优惠价：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <input type="text" class="input-text" name="sale_price" id="sale_price" placeholder="实际价格=价格-优惠">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>专业时长(单位：小时)：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <input type="text" class="input-text" name="duration" id="duration">
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
                    <input type="hidden" name="cover" value="">
                    <!-- 定义一个标签用来存放图片的预览图 -->
                    <div id="webuploader-img" style="margin-bottom: 1px;">
                        <img src="/home/uploader.jpg" style="width:150px;height: 150px;filter: grayscale(100%);">
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
                    <div class="btn btn-primary radius" id="webuploder-start" style="font-size: 12px; height: 26px;">上传文件</div>
                </div>
            </div>


            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>有效时间(单位：天)：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <input type="text" class="input-text" name="expire_at" id="expire_at">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>点击量：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <input type="text" class="input-text" name="click" id="click">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>学习人数：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <input type="text" class="input-text" name="number" id="number">
                </div>
            </div>



            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">轮播图：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    {{-- 声明一个专门用于获取上传成功图片的表单列表 --}}
                    <div id="banner-list">

                    </div>
                    {{-- 用于放置zyupload插件的地方 --}}
                    <div id="zyupload-box"></div>
                </div>
            </div>



            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否推荐专业：</label>
                <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                    <div class="radio-box">
                        <input name="is_recommend" type="radio" value="1" id="recommend-1" checked>
                        <label for="recommend-1">是</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" id="recommend-2" value="0" name="is_recommend">
                        <label for="recommend-2">否</label>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否精品专业：</label>
                <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                    <div class="radio-box">
                        <input name="is_best" type="radio" value="1" id="best-1" checked>
                        <label for="best-1">是</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" id="best-2" value="0" name="is_best">
                        <label for="best-2">否</label>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否热门专业：</label>
                <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                    <div class="radio-box">
                        <input name="is_hot" type="radio" value="1" id="hot-1" checked>
                        <label for="hot-1">是</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" id="hot-2" value="0" name="is_hot">
                        <label for="best-2">否</label>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>排序：</label>
                <div class="formControls col-xs-4 col-sm-6">
                    <input type="text" class="input-text" name="sort" id="sort" placeholder="数值越大，越靠前！">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课程详情：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <textarea name="content" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true"></textarea>
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
{{-- zyupload插件,建议不要引用辉哥的那个，引用原本的作者的 --}}
<script src="/admin/lib/zyUpload/core/zyFile.js"></script>
<script src="/admin/lib/zyUpload/control/js/zyUpload.js"></script>
{{-- jQuery.validation验证插件 --}}
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
    $(function(){

        /*
          定义zyupload的csrf_token和名称
        */
        zyuploader_field_name = 'uploader'; //把zyupload的file表单修改为name=uploader
        zyuploader_headers = '_token';  //追加一个zyuploader_headers的名称为_token
        csrf_token = '{{csrf_token()}}'; //追加_token的值
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
                $preview.html('<img src="/home/uploader.jpg" style="width:150px;height: 90px;filter: grayscale(100%);">');
            }
        });



        // zyupload多文件上传插件
        var zyUpload = $('#zyupload-box').zyUpload({
            width            :   "507px",                 // 宽度
            height           :   "auto",                 // 高度
            itemWidth        :   "74px",                 // 文件项的宽度
            itemHeight       :   "60px",                 // 文件项的高度
            url              :   "{{ url('System/Uploader/Upload') }}",  // 上传文件的路径
            multiple         :   true,                    // 是否可以多个文件上传
            dragDrop         :   true,                    // 是否可以拖动上传文件
            del              :   true,                    // 是否可以删除文件
            finishDel        :   false,           // 是否在上传文件完成后删除预览
        });

        // 当文件上传成功以后的回调函数
        ZYFILE.onSuccess = function(file, responseInfo){
            //上传成功把进度条去掉
            $("#uploadProgress_" + file.index).hide();
            //把成功标志显示出来
            $("#uploadSuccess_" + file.index).show();
            //因为成功后,获取json数据zyupload当中是字符串而不是对象
            var msg = $.parseJSON(responseInfo);
            if(msg.status){
                // 上传文件成功,在banner-list对象中插入表单
                $('#banner-list').append('<input data-index="'+file.index+'" type="hidden" name="banner[]" value="'+msg.file+'" />');
            }else{
                // 上传文件失败！
                $('#uploadList_'+file.index).remove();
            }
        };

        // 上传文件失败！
        ZYFILE.onFailure = function( file, responseInfo ){
            $("#uploadProgress_" + file.index).hide();
            $("#uploadSuccess_" + file.index).hide();
            //$("#uploadInf").append("<p>文件" + file.name + "上传失败！</p>");
            //上传失败,直接把上传队列中失败图片删除
            $('#uploadList_'+file.index).remove();
        }

        // 点击删除上传的文件
        ZYFILE.onDelete = function(file, files){
            $("#uploadList_" + file.index).fadeOut();
            //删除指定图片对应的保存表单值
            $("input[data-index="+file.index+"]").remove();
        }



        $("#form-admin-store-add").validate({
                rules:{
                    profession_name:{
                        required:true,
                    },
                    price:{
                        required:true,
                        digits:true
                    },
                    sale_price:{
                        required:true,
                        digits:true
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
