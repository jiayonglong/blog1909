<?php
/**
 * 公共文件
 */
 //文件上传
    function upload($img){
        //判断上传是否有误
        if(request()->file($img)->isValid()){
            //接受文件
            $file = request()->$img;
            $store_result = $file->store('uploads');
            return $store_result;
        }
        exit('上传出错');
    }
     function Moreupload($img){
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
    //无限积分类
    function CreateTree($data,$pid=0,$level=0){
        if(!$data){
            return;
        }
        static $newArray=[];
        foreach($data as $v){
            if($v->pid==$pid){
                $v->level = $level;
                $newArray[]=$v;
                CreateTree($data,$v->cate_id,$level+1);
            }
        }
        return $newArray;
    }

?>