<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\User;
use App\Category;
use App\Goods;
use App\Cart;
use App\Order;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    // public function index(){
    //     $goods = new Goods();
    //     $ishuan = $goods::where('is_huan',1)->take(5)->get();
    //     $isbest = $goods::count();
    //     $cate = Category::where('pid',0)->get();
    //     $isnew = $goods::where('is_new',1)->take(8)->get();
    //     $iscu = $goods::where('is_cu',1)->take(3)->get();

    //     return view('index.index',['ishuan'=>$ishuan,'isbest'=>$isbest,'cate'=>$cate,'isnew'=>$isnew,'iscu'=>$iscu]);
    // }
       public function index(){
        $goods = new Goods();
        $is_huan = Cache::get('is_huan');
        // $is_huan = cache('is_huan');
        // dump($is_huan);
        if(!$is_huan){
            $is_huan = Cache::getSlideDate();
            //$is_huan =is_huan::select('goods_id','goods_img')->where('is_huan',1)->orderBy('goods_id','desc')->take(5)->get();
        
        Cache::put('is_huan',$is_huan,60*60*24);
        //cache(['is_huan'=>$is_huan],60*60*24);
        }
        //   $ishuan = $goods::where('is_huan',1)->take(5)->get();
        $isbest = $goods::count();
        $cate = Category::where('pid',0)->get();
        $isnew = $goods::where('is_new',1)->take(8)->get();
        $iscu = $goods::where('is_cu',1)->take(3)->get();
        return view('index.index',['is_huan'=>$is_huan,'isbest'=>$isbest,'cate'=>$cate,'isnew'=>$isnew,'iscu'=>$iscu]);
    }
     public function pronav($id){
        $count = Cache::add('count_'.$id,1)?Cache::get('count_'.$id):Cache::increment('count_'.$id);
        $goods =  Goods::where('goods_id',$id)->get();
        return view('index/pronav.pronav',['goods'=>$goods,'id'=>$id,'count'=>$count]);
    }

    public function prolist(){
        $goods =  Goods::all();
     return view('index/pronav.prolist',['goods'=>$goods]);
 }




//  public function cartlist(){

//     $cartInfo = Cart::all();
//     $count = Cart::join('Goods','Goods.goods_id','=','Cart.goods_id')
//      ->join('User','User.user_id','=','Cart.user_id')->get();
//  return view('index.car.cartlist',['count'=>$count,'cartInfo'=>$cartInfo]);
// }
 public function cartlist(){
    	$cartInfo = Cart::all();
    	$count = Cart::count();
    	return view('index.car.cartlist',['cartInfo'=>$cartInfo,'count'=>$count]);
    }

public function addcar(request $request){

    // $user_id = session('user');
    // // $user_id=1;
    // if(!$user_id){
    //     return json_encode(['no'=>'0','msg'=>'请先登录']);
    // }

    $goods_id = $request->goods_id;
    $buy_num = $request->buy_num;
    // echo $goods_id;
    // echo $buy_num;
    $goods = Goods::find($goods_id);
    if($goods->goods_num<$buy_num){
        return json_encode(['no'=>'000','msg'=>'存库不足']);
    }
    $cart = Cart::where(['goods_id'=>$goods_id])->first();
    if($cart){
        $buy_num = $cart->b_num+$buy_num;
        if($goods->goods_num<$buy_num){
            $buy_num = $goods->goods_num;
        }
        $res = Cart::where('cart_id',$cart->cart_id)->update(['b_num'=>$buy_num]);

    }else{
        $data=[
            // 'user_id'=>$user_id,
            'goods_id'=>$goods_id,
            'goods_img'=>$goods->goods_img,
            'goods_name'=>$goods->goods_name,
            'goods_price'=>$goods->goods_price,
            'b_num'=>$buy_num,
            'create_time'=>time()
        ];
        $res = Cart::create($data);
    }
            if($res){
            return json_encode(['no'=>'1','msg'=>'添加成功']);
        }

}
//去结算
public function pay(request $request){
    $goods_ids = $request->ids;
    $goods_id = explode(',',$goods_ids);
    $goods = Goods::whereIn('goods_id',$goods_id)->get();
   return view('index.pay',['goods'=>$goods,'goods_id'=>$goods_id]);
}
public function user(){
    // $user_id = cookie('user_id');
    // $user =  User::where('user_id',$user_id)->get();
    return view('index/user');
}
public function success($id){
        $goods_id = $id;
        // $user_id = cookie('user_id');
       
        $user_id = 18;
        $order_no = rand(1000,9999).time();
          $order_id = $id;

        $data = [
            'user_id'=>$user_id,
            'create_time'=>time(),
            'order_no'=>$order_no
        ];
        $ret = Order::create($data);
        if($ret){

            return view('index.success',['order_no'=>$order_id]);
        }
}
}