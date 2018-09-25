<?php
namespace App\Service;

use App\Models\Image;

/**
 * 图片处理service
 * @author YZ
 *
 */
class ImageService{
    
    protected static $_instance;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private function __construct()
    {
    
    }
    
    public static function getInstance(){
        if(!self::$_instance instanceof self){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * 图片入库
     * @param int $p_id
     * @param string $url
     */
    public function saveImage(int $p_id,string $url){
        $res = ['code' => 501,'msg' => '','data' => []];
        if($p_id && $url){
            $orm = new Image();
            $orm->p_id = $p_id;
            $orm->url = $url;
            $orm->type = 1;
            $suc = $orm->save();
            if($suc){
                $res = ['code' => 200,'msg' => '成功','data' => []];
            }else{
                $res = ['code' => 504,'msg' => '图片入库失败','data' => []];
            }           
        }
        return $res;
    }
}
?>