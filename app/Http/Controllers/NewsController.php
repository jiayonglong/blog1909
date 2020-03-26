<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\News;
use Illuminate\Support\Facades\Redis;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //    Redis::flushall();
        $page = request()->page??1;
        $news_name = request()->news_name??'';
        $news=Redis::get('newslist_'.$page.'_'.$news_name);
		dump('newslist_'.$page.'_'.$news_name);
      if(!$news){
          echo "DB =====";
		// $news_name=request()->news_name;

		$where=[];
		if($news_name){
		   $where[]=['news_name','like',"%$news_name%"];
		}

		$pageSize=config('app.pageSize');
		$news=News::select('news.*','category.cate_name')
			->leftjoin('category','news.cate_id','=','category.cate_id')
			->where($where)->
			orderby('news_id','desc')
			->paginate($pageSize);
		$news=serialize($news);
		Redis::setex('newslist_'.$page.'_'.$news_name,5*60,$news);
        
      }
	  $news=unserialize($news);
      //dd($news);
		if(request()->ajax()){
		    return view('news.ajaxpage',['news'=>$news]);
		}
        return view('news.index',['news'=>$news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Category::all();
        $cate = CreateTree($cate);
        return view('news.create',['cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = request()->validate([
            'news_name' => 'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,30}$/u',
            'news_men' => 'required',
        ],[
            'news_name.required'=>'新闻标题不能为空！',
            'news_name.regex'=>'新闻名称可以包括中文，数字，字母，下划线，长度2~30位',
            'news_men.required'=>'新闻作者不能为空！',
        ]);
        $post = $request->except('_token');
        $post['news_time']=time();
        $res = News::insert($post);
        if($res){
            return redirect('/news/index',);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
