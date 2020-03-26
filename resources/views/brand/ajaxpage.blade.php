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
				<a href="{{url('/brand/destroy/'.$v->brand_id)}}" class="btn btn-danger">删除</a></th>
            </tr>
		@endforeach
		<tr><td colspan="6">{{$brand->appends($query)->links()}}</td></tr>