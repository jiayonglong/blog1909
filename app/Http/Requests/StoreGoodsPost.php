<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoodsPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //获取当前路由名称
        $name = \Route::currentRouteName();
        if($name=='goodsstore'){
        return [
             'goods_name' => 'regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u|unique:goods',
            'goods_huo' => 'required',
            'cate_id'=>'required',
            'brand_id'=> 'required',
            'goods_price'=> 'required',
            'goods_num'=> 'required|digits_between:1,8',
        ];
        }
    }
}
