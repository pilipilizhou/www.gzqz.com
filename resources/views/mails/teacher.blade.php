<!DOCTYPE html>
<html>
<head>
	<title>老师直播通知模板(email)</title>
	<meta charset="utf-8">
	<style>
			/* email只支持内部样式 */
			*{
				font-size:12px;
				font-family: 'Microsoft YaHei';
			}
			table{
				border: 1px solid #ccc;
				margin: 0 auto;
				with:520px;
			}
			tr,td{
				border:1px solid #ccc;
			}
			td{
				text-align: center;
				line-height: 22px;
			}
	</style>
</head>
<body>
		<table>
			<tr>
				<td>老师姓名:</td>
				<td>{{$teacher}}</td>
			</tr>


			<tr>
				<td>直播课程:</td>
				<td>{{$course_name}}</td>
			</tr>

			<tr>
				<td>直播开始时间:</td>
				<td>{{$start_at}}</td>
			</tr>

			<tr>
				<td>直播结束时间:</td>
				<td>{{$end_at}}</td>
			</tr>

			<tr>
				<td>直播推流地址:</td>
				<td>{{$push}}</td>
			</tr>

			<tr>
				<td>直播观看地址:</td>
				<td>{{$pull}}</td>
			</tr>

		</table>
</body>
</html>