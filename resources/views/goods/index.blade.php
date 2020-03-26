<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品列表</h2></center>
<a href="{{url('/goods/create')}}" type="button" class="btn btn-warning">添加</button></a>
<form>
	<input type="text" name="goods_name"  placeholder="请输入关键字">
	<button>搜索</button>
</form>
<div class="table-responsive">
	<table class="table" > 
		<caption></caption>
		<thead>
			<tr>
				<th>商品ID</th>
				<th>商品名称</th>
				<th>商品货号</th>
				<th>商品分类</th>
                <th>商品品牌</th>
                <th>商品价格</th>
                <th>商品库存</th>
                <th>是否显示</th>
				<th>是否新品</th>
				<th>是否精品</th>
				<th>商品图片</th>
				<th>商品相册</th>
				<th>商品详情</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($goods as $v)
		<tr>
				<th>{{$v->goods_id}}</th>
				<th>{{$v->goods_name}}</th>
				<th>{{$v->goods_huo}}</th>
				<th>{{$v->cate_name}}</th>
                <th>{{$v->brand_name}}</th>
                <th>{{$v->goods_price}}</th>
                <th>{{$v->goods_num}}</th>
				<th>{{$v->is_show?'√':'×'}}</th>
				<th>{{$v->is_new?'√':'×'}}</th>
				<th>{{$v->is_best?'√':'×'}}</th>
				<th><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="40" height="40"></th>
				<th>
					@if($v->goods_imgs)
					@php $goods_imgs= explode('|',$v->goods_imgs); @endphp
					@foreach ($goods_imgs as $vv)
					<img src="{{env('UPLOADS_URL')}}{{$vv}}" width="40" height="40">
					@endforeach
					@endif
				</th>
				<th>{{$v->goods_desc}}</th>
				<th><a href="{{url('/goods/edit/'.$v->goods_id)}}" type="button" class="btn btn-primary">修改</a>
				   -<a href="{{url('/goods/destroy/'.$v->goods_id)}}" type="button" class="btn btn-danger">删除</a></th>
			</tr>
			@endforeach
		<tr><td colspan="6">{{$goods->links()}}</td></tr>
		</tbody>
</table>
</div>  	

</body>
</html>