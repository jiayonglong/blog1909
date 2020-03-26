<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Brand;
//use App\Http\Requests\StoreBrandPost;
use Validator;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //存储session
        //  session(['name'=>'zhangsan']);
        //  request()->session()->put('number',100);
         //request()->session()->save();

        //删除
        //  session(['name'=>null]);
        //  request()->session()->forget('number');
        //删除所有
        //  request()->session()->flush();

        //获取session
        //  echo session('name');
        //  echo request()->session()->get('number');
        // //获取所有
        // dump(request()->session()->all());

        $name = request()->name;
        $where = [];
        if($name){
            $where[] = ['brand_name','like',"%$name%"];
        }
        $url = request()->url;
        if($url){
            $where[] =['brand_url','like',"%$url%"];
        }
        $pageSize = config('app.pageSize');
        // $brand = DB::table('brand')->select('brand_name','brand_desc')->get();
        // $brand = DB::table('brand')->get();

        //ORM
        // $brand = Brand::all();
        // $brand = Brand::get();
        $brand = Brand::where($where)->orderby('brand_id','desc')->paginate($pageSize);
        $query = request()->all();
         if(request()->ajax()){
            return view('brand.ajaxpage',['brand'=>$brand,'query'=>$query]);
        }
        return view('brand.index',['brand'=>$brand,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *添加界面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    //第二种
    //public function store(StoreBrandPost $request)
    {
        //第一种
        // $validatedData = $request->validate([
        //     'brand_name'=>'required|unique:brand|max:20',
        //     'brand_url'=>'required',
        // ],[
        //     'brand_name.required'=>'品牌名称必填',
        //     'brand_name.unique'=>'品牌名称已存在',
        //     'brand_name.max'=>'品牌名称最大长度不超20',
        //     'brand_url.required'=>'品牌网址必填',

        // ]);
        $post = $request->except('_token');
        // dd($post);


        $validator = Validator::make($post,[
        'brand_name'=>'required|unique:brand|max:20',
        'brand_url'=>'required',
        ],[
            'brand_name.required'=>'品牌名称必填',
            'brand_name.unique'=>'品牌名称已存在',
            'brand_name.max'=>'品牌名称最大长度不超20',
            'brand_url.required'=>'品牌网址必填',
        ]);
        if ($validator->fails()) {
            return redirect('brand/create')
            ->withErrors($validator)
            ->withInput();
        }
        if($request->hasFile('brand_logo')){
            $post['brand_logo']  = upload('brand_logo');
            // dd($img);
        }
         //多文件上传
        if($request->hasFile('brand_img')){
            $brand_img = Moreupload('brand_img');
            $post['brand_img'] = implode('|',$brand_img);
        }
        //$res = DB::table('brand')->insert($post);
        // dd($res);

        //ORM
        // $brand = new Brand;
        // $brand->brand_name = $request->brand_name;
        // $brand->brand_url = $request->brand_url;
        // $brand->brand_logo = $request->brand_logo;
        // $brand->brand_desc = $request->brand_desc;
        // $res = $brand->save();

        //第二种
        //$res = Brand::create($post);
        //第三种
        $res = Brand::insert($post);
        if($res){
            return redirect('/brand/index');
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
        //$brand = DB::table('brand')->where('brand_id',$id)->first();

        //ORM
        //$brand = Brand::find($id);
        $brand = Brand::where('brand_id',$id)->first();
        return view('brand.edit',['brand'=>$brand]);
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
         if($request->hasFile('brand_logo')){
            $post['brand_logo']  = $this->upload('brand_logo');
            // dd($img);
        }
        //$res = DB::table('brand')->where('brand_id',$id)->update($post);

        //ORM
        // $brand = Brand::find($id);
        // $brand->brand_name = $request->brand_name;
        // $brand->brand_url = $request->brand_url;
        // $brand->brand_logo = $request->brand_logo;
        // $brand->brand_desc = $request->brand_desc;
        // $res = $brand->save();

        $res = Brand::where('brand_id',$id)->update($post);
        if($res!==false){
            return redirect('/brand/index');
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
        //  $res =  DB::table('brand')->where([['brand_id',$id]])->delete();
         $res = Brand::where('brand_id',$id)->delete();
         
         if($res){
            if(request()->ajax()){
                return json_encode(['error_no'=>'1','error_msg'=>'删除成功']);
             }
            return redirect('brand/index');
         }

    }
}
