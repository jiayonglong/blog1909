<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sou;
class SouController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sou = Sou::orderby('id','desc')->get();
        return view('sou.index',['sou'=>$sou]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sou.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->except('_token');
        // dd($post);
        if($request->hasFile('img')){
            $post['img']  = $this->upload('img');
            // dd($img);
        }
        //多文件上传
        if($request->hasFile('imgs')){
            $imgs = $this->Moreupload('imgs');
            $post['imgs'] = implode('|',$imgs);
        }
         $res = Sou::insert($post);
        if($res){
            return redirect('/sou/index');
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
    public function Moreupload($img){
        //接受文件
        $file = request()->$img;
        foreach($file as $k=>$v){
            if($v->isValid()){
               $store_result[$k] = $v->store('uploads');  
            }else{
                $store_result[$k] = '上传出错';
            }
        }
        return $store_result;
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
