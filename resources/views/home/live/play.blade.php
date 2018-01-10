<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/home/img/asset-favicon.ico">
    <title>在线教育网</title>

    <link rel="stylesheet" href="/home/css/page-learing-course-video.css" />
    <link rel="stylesheet" href="/home/plugins/normalize-css/normalize.css" />
    <link rel="stylesheet" href="/home/plugins/bootstrap/dist/css/bootstrap.css" />
</head>

<body>
    <!-- 页面头部 -->
    <div class="learing-course">
        <div>
            <!--<link rel="import" href="/home//home/modules/ui-modules/learing-profession-weeklist/learing-profession-weeklist.html?__inline">-->
            <div class="course-cont">
                <div class="course-cont-top-video" style="position: relative;height:500px;">
                    <div class="course-weeklist" style="left:0">
                        <div class="nav nav-stacked">
                            <div class="tit nav-justified text-center"><i class="pull-left glyphicon glyphicon-chevron-left"></i>第一周软件安装 <i class="pull-right">1/4</i></div>
                            <li><i class="glyphicon glyphicon-check"></i>分级政策细分 <span>视</span></li>
                            <li><i class="glyphicon glyphicon-unchecked"></i>为什么分为A、B、C部分</li>
                            <li><i class="glyphicon glyphicon-unchecked"></i>软安装介绍</li>
                            <li><i class="glyphicon glyphicon-unchecked"></i>Emacs安装 <span>阅</span></li>
                        </div>
                        <div class="course-nav" style='left:380px;'>

                        </div>
                    </div>
                    <div class="video-box" style='width:986px;'>
                        <div class="top text-center">
                            <i class="glyphicon glyphicon-align-justify pull-left hv-poin ck"></i>
                            {{$liveInfo->course_name}}
                                <i class="glyphicon glyphicon-book pull-right"></i>
                        </div>

<!-- 引导ckplayer的播放器核心js文件 -->
<script type="text/javascript" src="/ckplayer/ckplayer.js" charset="utf-8"></script>
<!-- 放置ckplayer的播放器的位置 -->
<div class="video text-center" style='width:900px;height:450px;clear:both;margin:auto;' id="show_video"> </div>
                       
<script type="text/javascript">
/*
        f:'/uploads/1.flv',       //拉流地址
        i:'',//视频封面图
        d:'',//暂停时播放的广告图片
        v:'60',//默认音量，0-100之间
        p:'0',//视频默认0是暂停，1是播放
        lv:'0',//是否是直播流，1则锁定进度栏
        c:0,
        b:1,
*/
    var flashvars={
        f:'{{$pull_address}}', //播放地址
        i:'/uploads/7.jpg',//视频封面图
        //d:'/uploads/1.jpg',//暂停时播放的广告图片
        v:'80',//默认音量，0-100之间
        p:'0',//视频默认0是暂停，1是播放
        lv:'0',//是否是直播流，1则锁定进度栏
        c:0,
        b:1,
    };
    //播放器的设置
    /*
    bgcolor背景颜色
    allowFullScreen:是否允许全屏播放
    wmode:支持透明
    */
    var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always',wmode:'transparent'};
    /*
    引入浏览器播放器flash插件
    '/ckplayer/ckplayer.swf' : 插件的位置
    'show_video' : 插件在网页的布局中显示的位置
    'ckplayer_a1':ckplayer的名称
    '600':ckplayer的宽度
    '400':ckplyaer的高度
    flashvars,params:浏览器传递给flash插件的相关系统参数,不能去除
    */
    CKobject.embedSWF('/ckplayer/ckplayer.swf','show_video','ckplayer_a1','600','400',flashvars,params); 
</script>




                    </div>
                </div>
                <div class="subtitle-cont">
                    <div class="container">
                        <div class="tit">
                            查看字幕文字 <i class="glyphicon glyphicon-save pull-right"></i>
                        </div>
                        <div class="search-area">
                            <input type="text" class="search-area nav-justified" placeholder="搜索文字字幕" value="">
                        </div>
                        <div class="video-textes">
                        {!! $liveInfo->course_desc !!}
                        </div>
                     
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- 页面底部 -->
    <!-- 页面 css js -->
    <script type="text/javascript" src="/home/plugins/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="/home/plugins/bootstrap/dist/js/bootstrap.js"></script>
    <script>
        $(function() {
    /*
            //$('body').css('height',$('.profession-cont').height()+'px')
            var vidHit = $('html').height() - 70;
            var vidCenHit = (vidHit - $('.video-play').height()) / 2;
            $('.profession-cont-top-video,.video').css('height', vidHit)
            $('.video-play').css('top', vidCenHit);
        */
            $('.video-box .glyphicon-align-justify').click(function() {
                var contWidth = $(document).width() - 380;
                if (!$(this).hasClass('ck')) {
                    $(this).addClass('ck');
                    $('.video-box').animate({
                        width: contWidth
                    }, 500);
                    $('.profession-weeklist').animate({
                        left: 0
                    }, 500);
                    $('.profession-nav').animate({
                        left: 380
                    }, 500)
                } else {
                    $(this).removeClass('ck');
                    $('.video-box').animate({
                        width: '100%'
                    }, 500)
                    $('.profession-weeklist').animate({
                        left: -380
                    }, 500)
                    $('.profession-nav').animate({
                        left: 0
                    }, 500)
                }

            });

        })

    </script>
</body>
