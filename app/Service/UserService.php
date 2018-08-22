<?php
namespace App\Service;
/**
 * 用户service
 * @author YZ
 *
 */
class UserService{

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
    
    
    public function openId($request){
        $res = array();
        $code = $request->input('code');
        $appid = config('wechat.appid');
        $appsecret = config('wechat.appsecret');
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$appsecret."&js_code=".$code."&grant_type=authorization_code";
        $json = goCurl($url);
        $res = json_decode($json,true);
        return $res;
    }
}
?>