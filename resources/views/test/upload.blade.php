<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>测试</title>
</head>
<body>
	<form action="{{url('/Test/Upload')}}" method="POST" enctype="multipart/form-data">
		{!! csrf_field() !!}
        <input type="file" name="img">
		<input type="submit" value="上传" >

	</form>
</body>
</html>
