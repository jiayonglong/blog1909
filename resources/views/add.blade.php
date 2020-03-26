<h1>控制器方法</h1><hr/>
<form action="{{url('/adddo')}}" method='post'>
{{csrf_field()}}
<!-- @csrf -->
<input type='text' name='name'>
<button>提交</button></form>