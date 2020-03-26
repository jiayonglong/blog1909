<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>学生添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body> 
<center><h1>学生添加</h1></center><hr/>
<form action="{{url('/student/store')}}" method="POST" class="form-horizontal" role="form">
{{csrf_field()}}
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="name"
				   placeholder="请输入学生名称">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生班级</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="class"
				   placeholder="请输入学生班级">
		</div>
	</div>
     <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生性别</label>
		<div class="col-sm-8">
			<input type="radio"  name="sex"value="男">男
            <input type="radio"  name="sex"value="女">女
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>