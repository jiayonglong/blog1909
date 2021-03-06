<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>分类添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body> 
<center><h1>分类添加</h1></center><hr/>
<form action="{{url('/category/store')}}" method="POST" class="form-horizontal" role="form">
{{csrf_field()}}
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="cate_name"
				   placeholder="请输入分类名称">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">父级分类</label>
		<div class="col-sm-8">
			<select name="pid"  class="form-control" id="lastname">
                <option value="0">--请选择--</option>
                @foreach($cate as $v)
                <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
                @endforeach
            </select>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-8">
			<textarea type="text" class="form-control" id="firstname" name="cate_show"
				   placeholder="请输入分类描述"></textarea>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否展示在导航栏</label>
		<div class="col-sm-8">
            <input type="radio"   name="cate_desc" value="是" checked>是
            <input type="radio"   name="cate_desc" value="否">否
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