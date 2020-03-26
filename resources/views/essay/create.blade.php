<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>文章管理添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body> 
<center><h1>文章管理添加</h1></center><hr/>
<form action="{{url('/essay/store')}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
{{csrf_field()}}
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="essay_name"
                   placeholder="请输入文章标题">
                   <b style="color:red">{{$errors->first('essay_name')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-8">
			<select name="cate_id"  class="form-control" id="lastname">
                <option value="">--请选择--</option>
                @foreach($cate as $v)
                <option value="{{$v->cate_id}}">{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
                @endforeach
            </select>
            <b style="color:red">{{$errors->first('cate_id')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-8">
            <input type="radio"   name="essay_zhong" value="普通" checked>普通
            <input type="radio"   name="essay_zhong" value="置顶">置顶
            <!-- <b style="color:red">{{$errors->first('essay_zhong')}}</b> -->
		</div>
    </div>
     <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-8">
            <input type="radio"   name="essay_shi" value="显示" checked>显示
            <input type="radio"   name="essay_shi" value="不显示">不显示
            <!-- <b style="color:red">{{$errors->first('essay_shi')}}</b> -->
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="essay_men"
                   placeholder="请输入文章作者">
                   <b style="color:red">{{$errors->first('essay_men')}}</b>
		</div>
    </div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">作者email</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="essay_email"
                   placeholder="请输入作者email">
                   <b style="color:red">{{$errors->first('essay_email')}}</b>
		</div>
	</div>
     <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-8">
			<textarea type="text" class="form-control" id="firstname" name="essay_desc"
                   placeholder="请输入网页描述"></textarea>
                   <b style="color:red">{{$errors->first('essay_desc')}}</b>
		</div>
    </div>
     <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-4">
			<input type="file" class="form-control" id="firstname" name="essay_img">
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