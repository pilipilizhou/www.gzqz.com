@extends('backend.common.common')
@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 直播管理 <span class="c-gray en">&gt;</span> 直播流列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray"> <span class="l"><a class="btn btn-primary radius" href="javascript:;" onclick="stream_add('添加直播流','{{ url('System/Stream/Add') }}','1100')"><i class="Hui-iconfont">&#xe600;</i> 添加直播流</a> </span> </div>
	<table class="table table-border table-bordered table-hover table-bg list-data">
		<thead>
			<tr>
				<th scope="col" colspan="7">直播流列表</th>
			</tr>
			<tr class="text-c">
				<th width="140">ID</th>
				<th width="500">流名称</th>
				<th>创建时间</th>
				<th width="70">操作</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
@endsection

@section('footer-js')
<!--请在下方写此页面业务相关的脚本-->
<script src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
{{-- jQuery.validation验证插件 --}}
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script>

	// Datatables数据表格显示插件
	$('.list-data').DataTable({
		// 设置单页实现的数据量
		"lengthMenu": [ [2, 4, 8, 20, -1],[2,4,8,20,'全部'] ], // -1表示全部
		// 是否开启分页功能
		"paging": true,
		// 是否显示分页辅助信息
		"info": true,
		// 是否开启搜索功能
		"searching": true,
		// 是否开启排序功能
		"ordering": true,
		// 设置默认排序的列
		"order": [[ 1, "asc" ]], // 默认以第二列正序来排列数据
		// 设置指定列开启排序
		"columnDefs": [{
		   "targets": [0,-1], //0 表示第一列； -1 表示倒数第一列
		   "orderable": false,
		}],
		// 是否保存排序的状态[就是页面关闭了以后，在打开还是否保持上一次的排序状态]
		"stateSave": true,
		// "serverSide": true, // 是否开启服务端的端口
		// ajax获取服务端的数据
		"ajax": {
		    "url": "{{ url('System/Stream/ApiList') }}", // ajax的请求地址
		    "type": "POST",
		     // 在Laravel中发送post请求必须保证附带csrf的token值
		    'headers': { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }, 
		},
		// ajax发送请求到控制器以后，返回的数据需要显示，使用columns来实现
		// columns 的值是一个数组，数组中每一个json对象就是一列数据
		"columns": [
    	// {'data':'字段名称',"defaultContent": "默认值",'className':'类名'},
    	// 如果字段不存在，则显示默认值，如果没有默认值，则页面空白！
    	{'data':'id',"defaultContent": "",'className':"text-c"},
    	{'data':'stream_name',"defaultContent": "",'className':"text-c"},
    	{'data':'created_at',"defaultContent": "",'className':"text-c"},
    	{'data':'b',"defaultContent": "",'className':"text-c"},
		],
		// 对一些复杂的要求的字段列，在回调方法中解决
		"createdRow": function(row,data,index){
			$(row).children().eq(-1).html(`<a title="编辑" href="javascript:;" onclick="stream_edit('编辑老师信息','{{url('/System/Stream/Edit')}}/`+ data.id +`' ,'`+ data.id +`')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>`);
		},
	});
	/*直播流-添加*/
	function stream_add(title,url,w,h){
		layer_show(title,url,w,h);
	}
	/*直播流-编辑*/
	function stream_edit(title,url,id,w,h){
		layer_show(title,url,w,h);
	}
</script>
@endsection
