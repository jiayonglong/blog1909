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