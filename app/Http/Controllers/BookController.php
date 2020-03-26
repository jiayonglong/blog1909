<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = request()->name;
        $where = [];
        if($name){
            $where[] = ['book_name','like',"%$name%"];
        }
        $pageSize = config('app.pageSize');
        $book = Book::where($where)->orderby('book_id','desc')->paginate($pageSize);
        $query = request()->all();
        return view('book.index',['book'=>$book,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
             'book_name' => 'required|unique:book|max:20|alpha_dash|between:2,15',
             'book_men' => 'required',
        ],[
            'book_name.required'=>'图书名称必填!',
            'book_name.unique'=>'图书名称已存在!',
            'book_name.between'=>'图书名称长度为2-15位!',
            'book_name.alpha_dash'=>'图书名称需是有中文字母下划线组成!',
            'book_men.required' => '作者必填',
        ]);

        $post = $request->except('_token');
        // dd($post);
        if($request->hasFile('book_fen')){
            $post['book_fen']  = $this->upload('book_fen');
            // dd($img);
        }
        $res = Book::insert($post);
        if($res){
            return redirect('/book/index');
        }

    }
    //文件上传
    public function upload($img){
        //判断上传是否有误
        if(request()->file($img)->isValid()){
            //接受文件
            $file = request()->$img;
            $store_result = $file->store('uploads');
            return $store_result;
        }
        exit('上传出错');
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
