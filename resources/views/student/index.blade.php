<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>学生添加列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>学生添加列表<a style="float:right" href="{{url('/student/create')}}" type="button" class="btn btn-default">添加</a></h1></center><hr/>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>学生id</th>
				<th>学生姓名</th>
				<th>学生班级</th>
				<th>学生性别</th>
                <th>操作</th>
			</tr>
		</thead>
		<tbody>
        @foreach ($student as $v)
			<tr>
				<td>{{$v->id}}</td>
				<td>{{$v->name}}</td>
				<td>{{$v->class}}</td>
				<th>{{$v->sex}}</th>
                <th><button type="button" >添加</button></th>
            </tr>
        @endforeach
		</tbody>
</table>
</div>  	

</body>
</html>