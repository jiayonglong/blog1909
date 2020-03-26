<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>管理员列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>管理员列表<a style="float:right" href="{{url('/user/create')}}" type="button" class="btn btn-default">添加</a></h1></center><hr/>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>用户ID</th>
				<th>管理员名字</th>
                <th>邮箱</th>
				<th>手机号</th>
				<th>头像</th>
                <th>操作</th>
			</tr>
		</thead>
		<tbody>
        @foreach ($user as $v)
			<tr>
				<td>{{$v->user_id}}</td>
				<td>{{$v->user_name}}</td>
                <td>{{$v->user_email}}</td>
                <th>{{$v->user_tel}}</th>
				<td>@if($v->user_img)<img src="{{env('UPLOADS_URL')}}{{$v->user_img}}" width="40"height="40">@endif</td>
                <th><a href="{{url('/user/edit/'.$v->user_id)}}" class="btn btn-primary">编辑</a>
				<a href="{{url('/user/destroy/'.$v->user_id)}}" class="btn btn-danger">删除</a></th>
            </tr>
		@endforeach
		</tbody>
</table>
</div>  	

</body>
</html>