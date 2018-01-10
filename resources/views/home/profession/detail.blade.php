<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:bd="http://www.baidu.com/2010/xbdml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IEedge">
    <title>{{ $professionInfo->profession_name }} -安课云课堂</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" href="/mhome/css/bootstrap.min.css">
    <link rel="stylesheet" href="/mhome/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/mhome/css/mylogin.css">
    <link rel="stylesheet" href="/mhome/css/myprofile.css">
    <link rel="stylesheet" href="/mhome/css/componet.css">
    <link rel="stylesheet" href="/mhome/css/header.css">
    <link rel="stylesheet" href="/mhome/css/iconfont.css">
    <link rel="stylesheet" href="/mhome/css/payCourseDetailPage.css">
    <link rel="stylesheet" href="/mhome/css/footer.css">
    <link rel="stylesheet" href="/mhome/css/iconfont.css">
    <link rel="stylesheet" href="/mhome/css/index.css">
    <script src="/mhome/js/hm.js"></script><script src="/mhome/js/jquery-1.12.1.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="/mhome/js/ZeroClipboard.js"></script>
    <script src="/mhome/js/ajax.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="/mhome/js/artTemplate.js"></script>
    <script type="text/javascript" src="/mhome/js/jquery.dotdotdot.js"></script>
    <script type="text/javascript" src="/mhome/js/layer.js"></script><link rel="stylesheet" href="/mhome/css/layer.css" id="layui_layer_skinlayercss">
    <script src="/mhome/js/jquery.pagination.js"></script>
    <script src="/mhome/js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
    <script src="/mhome/js/jquery.form.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/mhome/js/helpers.js" type="text/javascript" charset="utf-8"></script>
    <script src="/mhome/js/html5.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<header><div class="header_body"><div class="header_left"><a href="https://www.boxuegu.com/index.html"><img src="/mhome/img/logoko.png" alt="" class="logoko"></a><div class="path"><a href="{{url('/')}}" class="select">云课堂</a><a href="https://www.boxuegu.com/web/html/ansAndQus.html">问答精灵</a><a href="https://www.boxuegu.com/web/html/forum.html">博学社</a><a href="http://www.itheima.com/" target="_blank">线下学院</a></div> </div><div class="header_right"><a href="javascript:;" class="studentCenterBox">学习中心</a><div class="messageBox"><a href="javascript:;" data-id="mynews" class="message">消息</a><span class="messageCount"><em></em></span></div><span class="lineBetween">|</span><div class="loginGroup"> <div class="login" style="display:none;"><div class="dropdown" id="myDropdown"><div class="userPic"></div><div id="dLabel" data-target="#" role="button" aria-haspopup="true"><span class="name"></span><span class="caret"></span> </div><ul class="dropdownmenu" aria-labelledby="dLabel"><div class="pointer"></div><li><a data-id="mydata"><i class="iconfont icon-xueyuan"></i>我的资料</a></li><li><a data-id="idea"><i class="iconfont icon-yijianfankui"></i>意见反馈</a></li><li><a data-exit="exit"><i class="iconfont icon-tuichu"></i>安全退出</a></li> </ul></div></div><div class="logout" style="display: block;"><a class="btn-login btn-link" data-toggle="modal" data-target="#login" data-backdrop="static">登录</a> <a class="btn-register btn-link" href="https://www.boxuegu.com/web/html/login.html?ways=register">注册</a></div></div></div></div>

    <div class="modal" id="login" data-backdrop="static" style="display: none;"><div class="modal-dialog login-module" role="document"><div class="cymylogin"><div class="cymylogin-top clearfix"><div class="cymyloginclose" data-dismiss="modal" aria-label="Close" data-backdrop="static"></div><div class="cymyloginlogo">欢迎登录&nbsp;&nbsp;安课云课堂</div><div class="cymyloginhint cymlogin" style="top: 221px; display: block;">请输入6-18位密码</div></div><div class="cymylogin-bottom form-login"><input type="text" class="cyinput1 form-control" maxlength="30" placeholder="请输入手机号或邮箱" autocomplete="off"><div class="cymyloginclose1"></div><input type="password" class="cyinput2 form-control" maxlength="18" placeholder="请输入6-18位密码" autocomplete="off" style="border: 1px solid rgb(255, 64, 18);"><div class="cymyloginclose2"></div><button class="cymyloginbutton">登<em></em>录</button><div class="cymyloginpassword"><a class="atOnceRegister" href="https://www.boxuegu.com/web/html/login.html?ways=register">立即注册</a><a class="atOnceResetPassword" href="https://www.boxuegu.com/web/html/resetPassword.html">忘记密码?</a></div></div></div></div></div>

    <div class="consult_center">咨询中心</div><div class="online_consult"><a href="http://crm2.qq.com/page/portalpage/wpa.php?uin=800146955&amp;aty=2&amp;a=2&amp;curl=&amp;ty=1" target="_blank"><img src="/mhome/img/zixun.gif.png" alt=""><span>在线咨询</span></a></div><div class="phone_consult"><div class="phone_consult_box"><img src="/mhome/img/tel.gif.png" alt=""><span class="dianhuazixun">电话咨询</span></div><span class="phone_number">400-618-4000</span> </div><div class="sideWeixinBox"><div class="sideWeixin"><img src="/mhome/img/sideWeixinErma.png.png"><p>关注微信</p></div></div><a class="sideWeiboBox" href="http://weibo.com/u/5999622644?refer_flag=1001030102_&amp;is_hot=1" target="_blank"><div class="sideWeibo"><img src="/mhome/img/sideWeiboErma.png.png"><p>关注微博</p></div></a><div class="sideWeixinErma"><img src="/mhome/img/sideWeixin.png"><div class="sideSanjiao"><img src="/mhome/img/float_sanjiao.png"></div></div><div class="sideWeiboErma"><img src="/mhome/img/sideWeibopng.png"><div class="sideSanjiao1"><img src="/mhome/img/float_sanjiao.png"></div></div><div class="h_top" onclick="pageScroll();" style="display: block;"><span class="wrap"><img src="/mhome/img/top.png" alt=""><span class="h_top_s">top</span></span></div>

</header>

<div class="rTips"></div>
<div id="payCourseSlider" style="">
    <div class="payCourseItems clearfix">
        <ul class="clearfix" style="display:inline-block">
            <li class="cu-shou course-details notpointer">课程详情</li>
            <li class="cu-shou course-outline noClick">课程大纲</li>
            <li class="cu-shou course-teacher notpointer">授课老师</li>
            <li class="cu-shou course-problem notpointer">常见问题</li>
            <li class="cu-shou course-evaluate notpointer">学员评价</li>
        </ul>
        <a href="https://www.boxuegu.com/web/html/order.html?courseId=76" class="purchase" style="display: block;">立即报名</a>
        <a href="https://www.boxuegu.com/web/html/myStudyCenter.html?free=undefined" class="studyImmed" style="display: none;">立即学习</a>
    </div>
</div>
<div id="course-list">
    <div class="nav" id="NoShowIntroduct" style="display: block;">
        <a href="{{url('/')}}">云课堂</a><span> &gt; </span><span class="myClassName" style="margin-left:0px" href="/web/html/courseIntroductionPage.html?id=76&amp;courseType=0&amp;free=undefined">{{ $professionInfo->profession_name }}</span>
    </div>
    <div class="nav" id="showIntroduct">
        <a href="https://www.boxuegu.com/index.html">云课堂</a><span> &gt; </span><a class="myClassName" href="https://www.boxuegu.com/web/html/courseIntroductionPage.html?id=76&amp;courseType=0&amp;free=undefined">{{ $professionInfo->profession_name }}</a><span> &gt; </span><span style="margin-left:0px">课程详情</span>
    </div>
    <div class="bigpic">
        <div class="bigpic-title"><div class="bigpic-img"><img src="{{config('program.url')}}/{{ $professionInfo->cover }}"></div><div class="bigpic-body"><span class="bigpic-body-title"><span class="bigpic-body-title-nav">{{ $professionInfo->profession_name }}</span></span><span id="d_clip_button" class="shareCourse" data-clipboard-target="fe_text">分享课程，赚取学费<em>&gt;&gt;</em></span><p class="bigpic-body-text dot-ellipsis" title="{{ $professionInfo->profession_desc }}">{{ $professionInfo->profession_desc }}</p><p class="bigpic-body-list"><span class="body-list-right">主讲：{{ $professionInfo->teacher_ids }}</span><span class="body-list-right myTimes" title="课程时长" style="cursor:default">学习时长：{{ $professionInfo->duration }}小时</span><span title="学习人数" style="cursor:default">学习人数：{{ $professionInfo->number }}人已学习</span><span title="有效期" style="cursor:default;color:#333;" class="youxiaoqi">有效期：{{ $professionInfo->expire_at }}天<span class="yibaoming" style="display:none"><img src="/mhome/img/baoming.png"></span></span></p><p class="bigpic-body-money"><span class="bigpic-body-redmoney">￥{{ round($professionInfo->price - $professionInfo->sale_price ,2) }}</span><del class="bigpic-body-notmoney">￥{{ $professionInfo->price }}</del></p><div class="bigpic-body-btn"><a href="{{ url('/Home/Order/Order/profession/'. $professionInfo->id ) }}" class="gotengxun purchase">立即报名</a><a class="free-try-to-lean">免费试学</a></div></div></div>
    </div>
    <div id="introductBox">
        <div id="introduct">
            <div class="course" id="detail-course">
                <!--<div class="classgrand"></div>
                <div class="course-time">开课时间：<span>11111</span></div>
                 <div class="baoming storpHot"><em></em><span style="color:#333;">报名已结束</span></div>
                 <div class="daojishi daojishi' + index + '">距离开班<span>00</span>天<span>00</span>时<span>00</span>分<span>00</span>秒</div>
                <div class="online"><a style="background-color: #ccc;">在线报名</a></div>-->
            </div>
        </div>
    </div>

    <div class="zhanwei">

    </div>
    <div class="background-big"></div>
    <div id="sign-up-modal">

    </div>
    <div class="table-body clearfix">
        <div class="sidebar-body">
            <div class="sidebar-body-details">
                <div class="details-title">
                    <!--<div class="shu"></div>-->
                    <p class="sidebar-body-details-title">安课云课堂</p>
                </div>
                <p class="details-body">
                    安课在线教育平台。整合线下优质课程和纯熟的教学经验，开展在线教育，突破空间、地域、时间、费用的限制，让优质教育资源平等化。
                </p>
            </div>
            <div class="sidebar-body-QQ">
                <div class="details-title">
                    <!--<div class="shu"></div>-->
                    <p class="sidebar-body-details-title">资料申领</p>
                    <p style="color:#333;margin-left: 20px;font-size: 14px;margin-top: 58px;">更多课程视频资料免费领取</p>
                </div>
                <div class="sidebar-body-QQ-name">

                    <p class="greend-QQnumber"><span>QQ号 : </span><a href="tencent://AddContact/?fromId=50&amp;fromSubId=1&amp;subcmd=all&amp;uin=2416751717">1031219129</a></p></div>
            </div>
            <div class="relative-course"><div class="relative-course-top clearfix"><span>推荐课程</span><span class="by-the-arrow"><span class="curCount currentLunbo">1</span><span class="curCount">/</span><span class="curCount allLunbo">4</span><span class="prev" id="prev"></span><span class="next" id="next"></span></span></div><div class="relativeAnsNoData" style="display: none;"><img src="/mhome/img/my_nodata.png"><p>暂无数据</p></div><div class="relative-course-bottom slide-box clearfix"><div id="box" class="slideBox clearfix"><ul class="course boxContent clearfix"><li class="diyiye"><a href="https://www.boxuegu.com/web/html/payCourseDetailPage.html?id=77&amp;courseType=1&amp;free=0" target="_blank"><div class="img"><img src="/mhome/img/336eb94512234e20b26490661f666cf2.jpg"></div><span class="classCategory">点播</span><div class="detail"><p class="title" data-text="Web前端开发就业班" title="Web前端开发就业班">Web前端开发就业班</p><p class="info clearfix"><span><i>￥</i><span class="price">7000.00</span><del><i class="price1">￥</i>9900.00</del></span><span class="stuCount"><img src="/mhome/img/studentCount.png" alt=""><span class="studentCou">62</span></span></p></div></a></li><li><a href="https://www.boxuegu.com/web/html/payCourseDetailPage.html?id=125&amp;courseType=1&amp;free=0" target="_blank"><div class="img"><img src="/mhome/img/035ff49cca614aa5ad1c61358efe98ae.png"></div><span class="classCategory">点播</span><div class="detail"><p class="title" data-text="HTML5 + CSS3" title="HTML5 + CSS3">HTML5 + CSS3</p><p class="info clearfix"><span><i>￥</i><span class="price">299.00</span><del><i class="price1">￥</i>499.00</del></span><span class="stuCount"><img src="/mhome/img/studentCount.png" alt=""><span class="studentCou">44</span></span></p></div></a></li><li><a href="https://www.boxuegu.com/web/html/payCourseDetailPage.html?id=124&amp;courseType=1&amp;free=0" target="_blank"><div class="img"><img src="/mhome/img/9a7a45f22f4c4dd19752a486cc8a57ec.png"></div><span class="classCategory">点播</span><div class="detail"><p class="title" data-text="AngularJS" title="AngularJS">AngularJS</p><p class="info clearfix"><span><i>￥</i><span class="price">299.00</span><del><i class="price1">￥</i>499.00</del></span><span class="stuCount"><img src="/mhome/img/studentCount.png" alt=""><span class="studentCou">44</span></span></p></div></a></li><li><a href="https://www.boxuegu.com/web/html/payCourseDetailPage.html?id=123&amp;courseType=1&amp;free=0" target="_blank"><div class="img"><img src="/mhome/img/ebfa979d098848b6bd3c7b0bd9317568.jpg"></div><span class="classCategory">点播</span><div class="detail"><p class="title" data-text="Web前端开发基础班" title="Web前端开发基础班">Web前端开发基础班</p><p class="info clearfix"><span><i>￥</i><span class="price">299.00</span><del><i class="price1">￥</i>800.00</del></span><span class="stuCount"><img src="/mhome/img/studentCount.png" alt=""><span class="studentCou">1275</span></span></p></div></a></li></ul></div></div></div>
        </div>

        <div class="table-title">
            <div class="table-title-inset tab-">
                <span class="cu-shou course-details notpointer course-info">课程详情</span>
                <span class="cu-shou course-outline noClick course-list">课程大纲</span>
                <span class="cu-shou course-teacher notpointer course-teacher">授课老师</span>
                {{--<span class="cu-shou course-problem notpointer">常见问题</span>--}}
                {{--<span class="cu-shou course-evaluate notpointer">学员评价</span>--}}
                <span class="table-zhanwei"></span>
            </div>
        </div>

        <!-- tab切换项 -->
        <div class=" pagesBox clearfix " id="tab_pagesBox" >
            <div class="table-modal">

                <div class="table-school">
                    @foreach( $professionInfo->course as $course )
                        <div class="table-school-body">
                            <div class="details-div"><p class="details-div-title">{{ $course->course_name }}</p>
                                <div class="details-div-body">
                                    @foreach($course->lesson as $key=>$lesson)
                                        <p title="1-{{ $lesson->lesson_name }}">{{ $key+1 }}-{{ $lesson->lesson_name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
            </div>
            <div class="pages" style="display: none;">
                <div id="Pagination"></div>
            </div>
        </div>
        

    </div>
</div>
<script src="/mhome/js/payCourseDetailPage.js" type="text/javascript" charset="utf-8"></script>
<script src="/mhome/js/footer.js" type="text/javascript"></script><div class="footerDT">

    <footer><div class="content"><div class="content-item footer-bodys"><div class="content-item content-footer-link about-us"><ul class="gate"><li data-id="first" data-url="../html/aboutUs.html">关于我们<span>|</span></li><li data-id="two" data-url="../html/aboutUs.html">人才招聘<span>|</span></li><li data-id="three" data-url="../html/aboutUs.html">联系我们<span>|</span></li><li data-id="four" data-url="../html/aboutUs.html" class="noline">常见问题</li></ul></div><div class="trademark">京ICP备08001421号 京公网安备110108007702 Copyright @ 2016 安课 All Rights Reserved<span style="margin-right:5px;"></span><span id="cnzz_stat_icon_1260713417"><a href="http://www.cnzz.com/stat/website.php?web_id=1260713417" target="_blank" title="站长统计"><img border="0" hspace="0" vspace="0" src="img/pic1.gif"></a></span></div></div></div></footer></div><script src="/css/z_stat.php" type="text/javascript"></script><script src="/css/core.php" charset="utf-8" type="text/javascript"></script>
<script src="/mhome/js/placeHolder.js"></script>
<script type="text/javascript">
    $(function(){ $('input').placeholder(); });

    /*tab栏切换*/
        /*课程详情*/
        $(".course-info").on("click",function () {
            $('#tab_pagesBox').children('.table-modal').empty();
            $.ajax({
                type:'GET',
                // 登录路由地址
                url:'{{url("/Home/Profession/professionContent/".$professionInfo->id)}}',
                success:function (json) {
                    if(json.status){
                        // 替换页面
                        $('#tab_pagesBox').children('.table-modal').html(json.professionContent);

                    }else{
                        $('#tab_pagesBox').children('.table-modal').html(json.professionContent);
                    }

                }
            });
        });

        /*课程大纲*/
        $(".course-list").on("click",function () {
            $('#tab_pagesBox').children('.table-modal').empty();
            var domCourse = " <div class=\"table-school\">\n" +
                "                        @foreach( $professionInfo->course as $course )\n" +
                "                            <div class=\"table-school-body\">\n" +
                "                                <div class=\"details-div\"><p class=\"details-div-title\">{{ $course->course_name }}</p>\n" +
                "                                    <div class=\"details-div-body\">\n" +
                "                                            @foreach($course->lesson as $key=>$lesson)\n" +
                "                                                <p title=\"1-{{ $lesson->lesson_name }}\">{{ $key+1 }}-{{ $lesson->lesson_name }}</p>\n" +
                "                                            @endforeach\n" +
                "                                    </div>\n" +
                "                                </div>\n" +
                "                            </div>\n" +
                "                        @endforeach\n" +
                "                    </div>";
            $('#tab_pagesBox').children('.table-modal').html(domCourse);
        });

        /*授课老师*/
        $(".course-teacher").on("click",function () {
            $('#tab_pagesBox').children('.table-modal').empty();
            $.ajax({
                type:'GET',
                // 登录路由地址
                url:'{{url("/Home/Profession/professionTeachers/".$professionInfo->id)}}',
                success:function (json) {
                    if(json.status){
                        console.log(json.professionTeachers);
                        var teachers =  json.professionTeachers;
                        // 替换页面
                        var stringOne = " <div class=\"man w\">\n" +
                            "                    <div class=\"man-l-one\">\n" +
                            "                        <ul>\n";
                        var stringTwo = "";
                        for (var i = 0; i < teachers.length; i++) {
                            stringTwo +="<li>\n" +
                                "                                <a href=\"javascript:void(0);\">\n" +
                                "                                    <img src=\"{{config('program.url')}}/"+teachers[i].avatar+"\">\n" +
                                "                                    <div class=\"b-text\">\n" +
                                "                                        <div class=\"big\">\n" +
                                "                                            <p>"+teachers[i].cnname+"<span> 老师 </span></p>\n" +
                                "                                            "+teachers[i].remark+"\n" +
                                "                                        </div>\n" +
                                "                                    </div>\n" +
                                "                                </a>\n" +
                                "                            </li>";

                        }

                        var stringThree = "          </ul>\n" +
                            "                    </div>\n" +
                            "                </div>";
                        var allTeacherString = stringOne + stringTwo + stringThree;
                        $('#tab_pagesBox').children('.table-modal').html(allTeacherString);

                    }else{
                        $('#tab_pagesBox').children('.table-modal').html(json.professionContent);
                    }

                }
            });
        });

        


</script>

<div class="browserBody" style="display:none;"><div class="bcgop"></div><div class="browserBody-text"><p>您目前使用的浏览器可能无法实现最佳浏览效果，建议使用Chrome(谷歌)、Firefox(火狐)、Edge、IE9及IE9以上版本浏览器。</p><a href="https://www.boxuegu.com/web/html/Download.html">立即升级</a><img src="/mhome/img/BWcolse.png"></div></div></body></html>
