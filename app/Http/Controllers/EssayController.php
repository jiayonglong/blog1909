<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Essay;
use Validator;
use App\Category;

class EssayController extends Controller
{
     /**
     * Display a listing of the resource.
     *列表页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $essay_name = request()->essay_name;
        $where = [];
        if($essay_name){
            $where[]=['essay_name','like',"%$essay_name%"];
        }
       
        $pageSize = config('app.pageSize');
        $essay = Essay::select('essay.*','category.cate_name')
        ->leftjoin('category','essay.cate_id','=','category.cate_id')
        ->where($where)
        ->paginate($pageSize);
         $query = request()->all();
         if(request()->ajax()){
            return view('essay.ajaxpage',['essay'=>$essay,'query'=>$query]);
        }
        return view('essay.index',['essay'=>$essay]);
    }

    /**
     * Show the form for creating a new resource.
     *添加界面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate=Category::all();
        $cate = CreateTree($cate);
        // dd($cate);
        return view('essay.create',['cate'=>$cate,'cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = Request()->validate([
       'essay_name' => 'regex:/^[\x{4e00}-\x{9fa5}\w]$/u|unique:essay',
            'essay_name' => 'required',
            'cate_id'=>'required',
            'essay_men'=> 'required',
            'essay_email'=> 'required',
            'essay_desc'=> 'required',
          
        ],[
            'essay_name.regex'=>'文章标题可以包括中文，数字，字母，下划线',
            'essay_name.unique'=>'文章标题已经存在！',
            'essay_name.required'=>'文章标题不能为空！',
            'cate_id.required'=>'分类必选！',
            'essay_men.required'=>'文章作者不能为空',
            'essay_email.required'=>'作者email不能为空',
            'essay_desc.required'=>'网页描述不能为空',
        

        ]);
        $post = $request->except('_token');
        // dd($post);
        if($request->hasFile('essay_img')){
            $post['essay_img']  = upload('essay_img');
            // dd($img);
        }
        $res = Essay::insert($post);
        if($res){
            return redirect('/essay/index');
        }

    }
  
    /**
     * Display the specified resource.
     *详情页展示
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
        $essay = Essay::where('essay_id',$id)->first();
        return view('essay.edit',['essay'=>$essay]);
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
        //接受所有值
        $post = $request->except('_token');
        // dd($post);
         if($request->hasFile('essay_img')){
            $post['essay_img']  = upload('essay_img');
            // dd($img);
        }

        $res = Essay::where('essay_id',$id)->update($post);
        if($res!==false){
            return redirect('/essay/index');
        }
        // dd($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Essay::destroy($id);
        if($res){
            return redirect('/essay/index');
        }
    }
}
