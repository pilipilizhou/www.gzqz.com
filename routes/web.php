<?php 


// 定义前台的路由群组
Route::group(['prefix'=>'/Home'],function(){
	Route::get('/Index','Home\IndexController@Index');
});

// 定义后台的路由群组
Route::group(['prefix'=>'/System'],function(){
    // 把System/Index路由地址加上一个路由别名叫login
	Route::get('/Index','Backend\LoginController@Index')->name('login');   // route('login');
	Route::post('/Login','Backend\LoginController@Login');
});

// 定义后台的系统首页和欢迎页路由   并且接受Auth的nanagerAuth用户的认证模式
Route::group(['prefix'=>'/System/Home','middleware'=>['auth:managerAuth']],function (){
    // 系统首页
    Route::get('/Index',"Backend\HomeController@Index");
    // 系统欢迎页
    Route::get('/Welcome',"Backend\HomeController@Welcome");
    // 系统退出后台登录
    Route::get('/Logout','Backend\HomeController@Logout');
});
// 定义后台管理模块路由
Route::group(['prefix'=>'/System/Manager','middleware'=>['auth:managerAuth','rbac']],function (){
    // 管理员列表
    Route::get('/Index',"Backend\ManagerController@Index");
    // 管理员用于被datatables插件的ajax调用的数据
    Route::post('/ApiList',"Backend\ManagerController@ApiList");
    // 管理员添加页面
    Route::get('/Add',"Backend\ManagerController@Add");
    // 管理员入库(添加)的程序路由
    Route::post('/Store',"Backend\ManagerController@Store");
    // 管理员入库(删除)的程序路由，根据mg_id删除管理员
    Route::post('/Remove/{mg_id}',"Backend\ManagerController@Remove");
    // 管理员(查询要修改的管理员的程序路由)，根据mg_id来找到要修改的管理员记录，编辑页面路由
    Route::get('/Edit/{mg_id}',"Backend\ManagerController@Edit");
    // 管理员入库(保存修改)的程序路由
    Route::post('/Save/{mg_id}',"Backend\ManagerController@Save");
   
});


// 定义后台学科模块路由
Route::group(['prefix'=>'/System/Subject','middleware'=>['auth:managerAuth']],function (){
    // 学科列表
    Route::get('/Index',"Backend\SubjectController@Index");
    // 学科用于被datatables插件的ajax调用的数据
    Route::post('/ApiList',"Backend\SubjectController@ApiList");
    // 学科添加页面
    Route::get('/Add',"Backend\SubjectController@Add");
    // 学科入库(添加)的程序路由
    Route::post('/Store',"Backend\SubjectController@Store");
    // 学科入库(删除)的程序路由，根据id删除学科
    Route::post('/Remove/{id}',"Backend\SubjectController@Remove");
    // 学科(查询要修改的学科的程序路由)，根据id来找到要修改的学科记录，编辑页面路由
    Route::get('/Edit/{id}',"Backend\SubjectController@Edit");
    // 学科入库(保存修改)的程序路由
    Route::post('/Save/{id}',"Backend\SubjectController@Save");
});

// 定义后台专业模块路由
Route::group(['prefix'=>'/System/Professional','middleware'=>['auth:managerAuth']],function (){
    // 专业列表
    Route::get('/Index',"Backend\ProfessionalController@Index");
    // 专业用于被datatables插件的ajax调用的数据
    Route::post('/ApiList',"Backend\ProfessionalController@ApiList");
    // 专业添加页面
    Route::get('/Add',"Backend\ProfessionalController@Add");
    // 专业入库(添加)的程序路由
    Route::post('/Store',"Backend\ProfessionalController@Store");
    // 专业入库(删除)的程序路由，根据id删除专业
    Route::post('/Remove/{id}',"Backend\ProfessionalController@Remove");
    // 专业(查询要修改的专业的程序路由)，根据id来找到要修改的专业记录，编辑页面路由
    Route::get('/Edit/{id}',"Backend\ProfessionalController@Edit");
    // 专业入库(保存修改)的程序路由
    Route::post('/Save/{id}',"Backend\ProfessionalController@Save");
});


// 定义后台课程模块路由
Route::group(['prefix'=>'/System/Course','middleware'=>['auth:managerAuth']],function (){
    // 课程列表
    Route::get('/Index',"Backend\CourseController@Index");
    // 课程用于被datatables插件的ajax调用的数据
    Route::post('/ApiList',"Backend\CourseController@ApiList");
    // 课程添加页面
    Route::get('/Add',"Backend\CourseController@Add");
    // 课程入库(添加)的程序路由
    Route::post('/Store',"Backend\CourseController@Store");
    // 课程入库(删除)的程序路由，根据id删除课程
    Route::post('/Remove/{id}',"Backend\CourseController@Remove");
    // 课程(查询要修改的课程的程序路由)，根据id来找到要修改的课程记录，编辑页面路由
    Route::get('/Edit/{id}',"Backend\CourseController@Edit");
    // 课程入库(保存修改)的程序路由
    Route::post('/Save/{id}',"Backend\CourseController@Save");
});

//上传的控制器路由
Route::group(['prefix'=>'/System/Uploader','middleware'=>['auth:managerAuth']],function (){
    // 上传一般是post路由
    Route::post('/Upload',"Backend\UploaderController@Upload");
});


//定义后台的课时模块路由
Route::group(['prefix'=>'/System/Lesson'],function(){
    // 课时列表
    Route::get('/Index',"Backend\LessonController@Index");
    // 课时用于被datatables插件的ajax调用的数据
    Route::post('/ApiList',"Backend\LessonController@ApiList");
    // 课时添加页面
    Route::get('/Add',"Backend\LessonController@Add");
    // 课时入库(添加)的程序路由
    Route::post('/Store',"Backend\LessonController@Store");
    // 课时入库(删除)的程序路由，根据id删除课时
    Route::post('/Remove/{id}',"Backend\LessonController@Remove");
    // 课时(查询要修改的课时的程序路由)，根据id来找到要修改的课时记录，编辑页面路由
    Route::get('/Edit/{id}',"Backend\LessonController@Edit");
    // 课时入库(保存修改)的程序路由
    Route::post('/Save/{id}',"Backend\LessonController@Save");
});

// 定义后台管理模块路由
Route::group(['prefix'=>'/System/Role','middleware'=>['auth:managerAuth']],function (){
    // (角色)列表
    Route::get('/Index',"Backend\RoleController@Index");
    // (角色)用于被datatables插件的ajax调用的数据
    Route::post('/ApiList',"Backend\RoleController@ApiList");
    // (角色)添加页面
    Route::get('/Add',"Backend\RoleController@Add");
    // (角色)入库(添加)的程序路由
    Route::post('/Store',"Backend\RoleController@Store");
    // (角色)入库(删除)的程序路由，根据mg_id删除(角色)
    Route::post('/Remove/{mg_id}',"Backend\RoleController@Remove");
    // (角色)(查询要修改的(角色)的程序路由)，根据mg_id来找到要修改的(角色)记录，编辑页面路由
    Route::get('/Edit/{mg_id}',"Backend\RoleController@Edit");
    // (角色)入库(保存修改)的程序路由
    Route::post('/Save/{mg_id}',"Backend\RoleController@Save");

});


// 定义老师管理模块路由
Route::group(['prefix'=>'/System/Teachers','middleware'=>['auth:managerAuth']],function (){
    // 老师列表
    Route::get('/Index',"Backend\TeacherController@Index");
    // 老师用于被datatables插件的ajax调用的数据
    Route::post('/ApiList',"Backend\TeacherController@ApiList");
    // 老师添加页面
    Route::get('/Add',"Backend\TeacherController@Add");
    // 老师入库(添加)的程序路由
    Route::post('/Store',"Backend\TeacherController@Store");
    // 老师入库(删除)的程序路由，根据mg_id删除老师
    Route::post('/Remove/{teacher_id}',"Backend\TeacherController@Remove");
    // 老师(查询要修改的老师的程序路由)，根据teacher_id来找到要修改的老师记录，编辑页面路由
    Route::get('/Edit/{teacher_id}',"Backend\TeacherController@Edit");
    // 老师入库(保存修改)的程序路由
    Route::post('/Save/{teacher_id}',"Backend\TeacherController@Save");
    
});



// 定义直播流管理模块路由
Route::group(['prefix'=>'/System/Stream','middleware'=>['auth:managerAuth']],function (){
    // 直播流列表
    Route::get('/Index',"Backend\StreamController@Index");
    // 直播流用于被datatables插件的ajax调用的数据
    Route::post('/ApiList',"Backend\StreamController@ApiList");
    // 直播流添加页面
    Route::get('/Add',"Backend\StreamController@Add");
    // 直播流入库(添加)的程序路由
    Route::post('/Store',"Backend\StreamController@Store");
    // 直播流入库(删除)的程序路由，根据mg_id删除直播流
    Route::post('/Remove/{id}',"Backend\StreamController@Remove");
    // 直播流(查询要修改的直播流的程序路由)，根据id来找到要修改的直播流记录，编辑页面路由
    Route::get('/Edit/{id}',"Backend\StreamController@Edit");
    // 直播流入库(保存修改)的程序路由
    Route::post('/Save/{id}',"Backend\StreamController@Save");

});

Route::group(['prefix'=>'/System/Live'],function(){
    Route::get('/Index',"Backend\LiveController@Index");
    Route::post('/ApiList',"Backend\LiveController@ApiList");
    Route::get('/Add',"Backend\LiveController@Add");
    Route::post('/Store',"Backend\LiveController@Store");
    Route::post('/Remove/{id}',"Backend\LiveController@Remove");
    Route::get('/Edit/{id}',"Backend\LiveController@Edit");
    Route::get('/LiveInfo/{live_id}',"Backend\LiveController@LiveInfo");
    Route::post('/Save/{id}',"Backend\LiveController@Save");
    //发送邮件的路由
    Route::get('/SendMail/{live_id}',"Backend\LiveController@SendMail");
    //发送短信的路由
    Route::get('/SendSms/{live_id}',"Backend\LiveController@SendSms");
});


// 定义后台权限模块路由
Route::group(['prefix'=>'/System/Permission','middleware'=>['auth:managerAuth']],function (){
    // 权限列表
    Route::get('/Index',"Backend\PermissionController@Index");
    // 权限用于被datatables插件的ajax调用的数据
    Route::post('/ApiList',"Backend\PermissionController@ApiList");
    // 权限添加页面
    Route::get('/Add',"Backend\PermissionController@Add");
    // 权限入库(添加)的程序路由
    Route::post('/Store',"Backend\PermissionController@Store");
    // 权限入库(删除)的程序路由，根据id删除权限
    Route::post('/Remove/{ps_id}',"Backend\PermissionController@Remove");
    // 权限(查询要修改的权限的程序路由)，根据id来找到要修改的权限记录，编辑页面路由
    Route::get('/Edit/{ps_id}',"Backend\PermissionController@Edit");
    // 权限入库(保存修改)的程序路由
    Route::post('/Save/{ps_id}',"Backend\PermissionController@Save");
});







// 定义会员的前台路由
Route::group(['prefix'=>'/Home/Members'],function (){
   // 前台登录页面
    Route::get('/Login','Home\MembersController@Login');
//    // 会员的登录程序
//    Route::post('/AjaxLogin','Home\MembersController@AjaxLogin');
//    // 前台注册页面
//    Route::get('/Register','Home\MembersController@Register');
//    // 会员登录ajax注册
//    Route::post('/AjaxRegister','Home\MembersController@AjaxRegister');


    // 会员登录
    Route::post('/checklogin','Home\MembersController@checkLogin');
    // 会员退出
    Route::get('/logout','Home\MembersController@logout');
    // 会员注册
//    Route::post('/SmsRegist','Home\MembersController@register');
    // 发送短信验证码
    Route::post('/sendSMSCode','Home\MembersController@sendSMSCode');
    // 校验登录名字是否已经有人注册
    Route::get('/checkNickName','Home\MembersController@checkNickName');
    // 提交信息和完成注册
    Route::post('/phoneRegist','Home\MembersController@phoneRegist');
    Route::get('/Welcome','Home\MembersController@Welcome');
});
// 定义会员的后台路由
Route::group(['prefix'=>'/System/Members'],function (){
    // 会员数据展示页面
    Route::get('/Index','Backend\MembersController@Index');
    // 会员数据datatables接口
    Route::post('/ApiList','Backend\MembersController@ApiList');
    // 删除会员
    Route::post('/Remove/{member_id}','Backend\MembersController@Remove');
    // 会员编辑页
    Route::get('/Edit/{member_id}','Backend\MembersController@Edit');
    // 会员编辑入库
    Route::post('/Save/{member_id}','Backend\MembersController@Save');
});
// 定义前台直播的路由群组
 Route::group(['prefix'=>'/Home/Live'],function(){
     // 把System/Index路由地址加上一个路由别名叫login
     Route::get('/Index','Home\LiveController@Index');
     Route::get('/Play/{live_id}','Home\LiveController@Play');
     // 直播详情
     Route::get('/live/{live}','Home\LiveController@detail');
 });



// 前台首页
Route::any('/','Home\MembersController@Welcome');
Route::group(['prefix'=>'/Home/Profession'],function (){
    // 获取专业详情
    Route::get('/Detail/{profession_id}','Home\ProfessionController@Detail');
    // 获取专业详情中的课程详情
    Route::get('/professionContent/{profession_id}','Home\ProfessionController@professionContent');
    // 获取专业详情中的授课老师
    Route::get('/professionTeachers/{profession_id}','Home\ProfessionController@professionTeachers');
});


Route::group(['prefix'=>'/Home/Order'],function (){
    // 确定订单
    Route::get('/Order/{type}/{id}','Home\OrderController@Sure');
    // 调用中间件验证用户是否登录了。
    Route::group(['middleware'=>'checkmemberlogin'],function(){
          // 生成订单
          Route::get('/order/{type}/{id}/make','Home\OrderController@make');

          // 会员中心
          Route::get('/member','Home\MembersController@index');
          // 会员退出
          Route::get('/logout','Home\MembersController@logout');

          // 发起支付
          Route::get('/pay/{order}','Home\OrderController@pay');
          // 微信支付
          Route::get('/wxpay/{order}','Home\OrderController@wxpay');
          // 查询微信支付的结果
          Route::get('/wxpay/query/{order}','Home\OrderController@query');
      });
});



// 点播
Route::group(['prefix'=>'/Home/playVideo'],function (){
    // 直播详情
    Route::get('/video/{lesson_id}','Home\PlayVideoController@index');
});












































/*Route::group(['prefix'=>'/History'],function() {
	Route::get('/Adidas','History\IndexController@Adidas');	
});*/

// 测试路由如下
Route::group(['prefix'=>'/Test'],function (){
    Route::get('/OA',"TestController@OA");
    Route::get('/Adidas',"TestController@Adidas");
    Route::get('/Nike',"TestController@Nike");
    Route::get('/Form','TestController@Form');
    Route::post('/Login','TestController@Login');
    Route::get('/TestCk','TestController@TestCk');
    Route::get('/ReadCk','TestController@ReadCk');
    Route::get('/SetSession','TestController@SetSession');
    Route::get('/GetSession','TestController@GetSession');

    Route::get('/GetStudents',"TestController@GetStudents");
    Route::get('/GetOne',"TestController@GetOne");
    Route::get('/InsertOne',"TestController@InsertOne");
    Route::get('/EditStu',"TestController@EditStu");
    Route::get('/DelStu',"TestController@DelStu");
    Route::get('/Search/{sid?}',"TestController@Search");
    Route::get('/getByWhere',"TestController@getByWhere");



    Route::get('/addNews',"TestController@addNews");
    Route::get('/editNews',"TestController@editNews");
    Route::get('/delNews',"TestController@delNews");
    Route::get('/getNews',"TestController@getNews");


    Route::get('/getInfo',"TestController@getInfo");
    Route::post('/Demo',"TestController@Demo");


    Route::get('/TestRedis',"TestController@TestRedis");
    Route::get('/Sickers',"TestController@Sickers");
    Route::get('/Doctor',"TestController@Doctor");
    Route::get('/In',"TestController@In");


    // 上传文件
    Route::post('/Upload',"TestController@Upload");
    Route::get('/FormUp',"TestController@FormUp");
    Route::get('/Img',"TestController@Img");
    Route::get('/InsertTest',"TestController@InsertTest");


});
