<?php
namespace App\Service;
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
     * @param unknown $p_id
     * @param string $url
     */
    public function saveImage($p_id,string $url){
        
    }
}
?>