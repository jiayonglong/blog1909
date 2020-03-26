<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品品牌添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body> 
<center><h1>商品品牌添加</h1></center><hr/>
<form action="{{url('/brand/store')}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
{{csrf_field()}}
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="brand_name"
				   placeholder="请输入品牌名称">
				    <b style="color:red">{{$errors->first('brand_name')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="brand_url"
				   placeholder="请输入品牌网址">
				   <b style="color:red">{{$errors->first('brand_url')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌LOGO</label>
		<div class="col-sm-4">
			<input type="file" class="form-control" id="firstname" name="brand_logo"
				   placeholder="请输入品牌LOGO">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌相册</label>
		<div class="col-sm-4">
			<input type="file" class="form-control" id="firstname" name="brand_img[]"
				   multiple="multiple">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌描述</label>
		<div class="col-sm-8">
			<textarea type="text" class="form-control" id="firstname" name="brand_desc"
				   placeholder="请输入品牌描述"></textarea>
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







