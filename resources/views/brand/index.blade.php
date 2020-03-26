<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>品牌列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>商品品牌列表<a style="float:right" href="{{url('/brand/create')}}" type="button" class="btn btn-default">添加</a></h1></center><hr/>
<div class="table-responsive">
	<form>
	<input type="text" name="name"  placeholder="请输入品牌关键字" value="{{$query['name']??''}}">
	<input type="text" name="url"  placeholder="请输入网址关键字" value="{{$query['url']??''}}">
	<button>搜索</button>
	</form>
	<table class="table">
		<thead>
			<tr>
				<th>品牌ID</th>
				<th>品牌名称</th>
                <th>品牌网址</th>
				<th>品牌LOGO</th>
				<th>品牌相册</th>
                <th>品牌描述</th>
                <th>操作</th>
			</tr>
		</thead>
		<tbody>
        @foreach ($brand as $v)
			<tr>
				<td>{{$v->brand_id}}</td>
				<td>{{$v->brand_name}}</td>
                <td>{{$v->brand_url}}</td>
				<td>@if($v->brand_logo)<img src="{{env('UPLOADS_URL')}}{{$v->brand_logo}}" width="40"height="40">@endif</td>
				 <td>@if($v->brand_img)
                    @php $brand_img = explode('|',$v->brand_img);
                    @endphp
                    @foreach($brand_img as $vv)    
                <img src="{{env('UPLOADS_URL')}}{{$vv}}" width="40"height="40">
                    @endforeach
                    @endif
                </td>
                <th>{{$v->brand_desc}}</th>
                <th><a href="{{url('/brand/edit/'.$v->brand_id)}}" class="btn btn-primary">编辑</a>
				<a href="javascript:void(0);" id="{{$v->brand_id}}" type="button" class="btn btn-danger">删除</a></th>
            </tr>
		@endforeach
		<tr><td colspan="6">{{$brand->appends($query)->links()}}</td></tr>
		</tbody>
</table>
</div>  	
<script>
	//ajax删除
	$('.btn-danger').click(function(){
				var id = $(this).attr('id');
				var isdel = confirm('确定删除吗?');
				if(isdel == true){
					$.get('/brand/destroy/'+id,function(rest){
						if(rest.error_no == '1'){
							location.reload();
						}
					},'json');
				}	
			
		});
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