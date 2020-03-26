<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>文章管理列表</h2></center>
<a href="{{url('/essay/create')}}" type="button" class="btn btn-warning">添加</button></a>
<form>
	<input type="text" name="essay_name"  placeholder="请输入关键字">
	<button>搜索</button>
</form>
<div class="table-responsive">
	<table class="table" > 
		<caption></caption>
		<thead>
			<tr>
				<th>ID</th>
				<th>文章标题</th>
				<th>文章分类</th>
				<th>文章重要性</th>
                <th>是否显示</th>
                <th>文章作者</th>
                <th>作者email</th>
                <th>网页描述</th>
				<th>文件上传</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($essay as $v)
		<tr>
				<th>{{$v->essay_id}}</th>
				<th>{{$v->essay_name}}</th>
				<th>{{$v->brand_name}}</th>
				<th>{{$v->essay_zhong?'√':'×'}}</th>
                <th>{{$v->essay_shi?'√':'×'}}</th>
                <th>{{$v->essay_men}}</th>
                <th>{{$v->essay_email}}</th>
                <th>{{$v->essay_desc}}</th>
				<th><img src="{{env('UPLOADS_URL')}}{{$v->essay_img}}" width="40" height="40"></th>
				<th><a href="{{url('/essay/edit/'.$v->essay_id)}}" type="button" class="btn btn-primary">修改</a>
				   -<a href="{{url('/essay/destroy/'.$v->essay_id)}}" type="button" class="btn btn-danger">删除</a></th>
			</tr>
			@endforeach
		<tr><td colspan="6">{{$essay->links()}}</td></tr>
		</tbody>
</table>
</div>  	
<script>
//分页
$(document).on('click','.pagination a',function(){
    // alert(111);
    var url = $(this).attr('href');
    $.get(url,function(result){
        $('tbody').html(result);
    });
    return false;
});
</script>
</body>
</html>