<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>新闻添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>新闻添加<a style="float: left;" href="{{url('/news/index')}}" class="btn btn-success">新闻列表</a></h2></center><hr/>

<!-- @if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>@endforeach
</ul>
</div>
@endif -->


<form action="{{url('/news/store')}}" method="post" class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">新闻标题</label>
		<div class="col-sm-8">
			<input type="text" name="news_name" class="form-control" id="firstname" >
			<b style="color:red">{{$errors->first('news_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">新闻分类</label>
		<div class="col-sm-8">
			<select name="cate_id"  class="form-control" id="lastname">
                <option value="">--请选择--</option>
                @foreach($cate as $v)
                <option value="{{$v->cate_id}}">{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
                @endforeach
            <select>
             <b style="color:red">{{$errors->first('cate_id')}}</b>
		</div>
    </div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">新闻作者</label>
		<div class="col-sm-8">
			<input type="text" name="news_men" class="form-control" id="firstname" >
			<b style="color:red">{{$errors->first('news_men')}}</b>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>