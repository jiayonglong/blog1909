<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>分类列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>分类列表<a style="float:right" href="{{url('/brand/create')}}" type="button" class="btn btn-default">添加</a></h1></center><hr/>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>分类ID</th>
				<th>分类名称</th>
                <th>父级分类</th>
                <th>分类描述</th>
                <th>是否展示在导航栏</th>
                <th>操作</th>
			</tr>
		</thead>
		<tbody>
        @foreach ($category as $v)
			<tr>
				<td>{{$v->cate_id}}</td>
				<td>{{$v->cate_name}}</td>
                <td>{{$v->pname}}</td>
                <td>{{$v->cate_show}}</td>
                <th>{{$v->cate_desc}}</th>
                <th><a href="{{url('/category/edit/'.$v->cate_id)}}" class="btn btn-primary">编辑</a>
				<a href="{{url('/category/destroy/'.$v->cate_id)}}" class="btn btn-danger">删除</a></th>
            </tr>
		@endforeach
		<tr><td colspan="6">{{$category->links()}}</td></tr>
		</tbody>
</table>
</div>  	

</body>
</html>