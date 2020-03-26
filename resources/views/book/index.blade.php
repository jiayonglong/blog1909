<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>图书管理列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>图书管理列表<a style="float:right" href="{{url('/book/create')}}" type="button" class="btn btn-default">添加</a></h1></center><hr/>
<div class="table-responsive">
	<form>
	<input type="text" name="name"  placeholder="请输入书名关键字" value="{{$query['name']??''}}">
	<button>搜索</button>
	</form>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>书名</th>
                <th>作者</th>
				<th>售价</th>
				<th>图书封面</th>
                <th>操作</th>
			</tr>
		</thead>
		<tbody>
        @foreach ($book as $v)
			<tr>
				<td>{{$v->book_id}}</td>
				<td>{{$v->book_name}}</td>
                <td>{{$v->book_men}}</td>
                 <th>{{$v->book_price}}</th>
				<td>@if($v->book_fen)<img src="{{env('UPLOADS_URL')}}{{$v->book_fen}}" width="40"height="40">@endif</td>
                <th><a href="{{url('/book/edit/'.$v->book_id)}}" class="btn btn-primary">编辑</a>
				<a href="{{url('/book/destroy/'.$v->book_id)}}" class="btn btn-danger">删除</a></th>
            </tr>
		@endforeach
		<tr><td colspan="6">{{$book->appends($query)->links()}}</td></tr>
		</tbody>
</table>
</div>  	

</body>
</html>