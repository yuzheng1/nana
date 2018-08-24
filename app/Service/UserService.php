<?php
namespace App\Service;
use Illuminate\Http\Request;
use App\Models\User;
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
    
    
    /**
     * 获取微信openid
     * @param Request $request
     * @author YZ
     */
    public function openId(Request $request){
        $res = ['code' => 501,'msg' => '','data' => []];
        $code = $request->input('code');
        $appid = config('wechat.appid');
        $appsecret = config('wechat.appsecret');
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$appsecret."&js_code=".$code."&grant_type=authorization_code";
        $json = goCurl($url);
        $data = json_decode($json,true);
        if(isset($data['openid']) && $data['openid']){
            $res = ['code' => 200,'msg' => '成功','data' => $data];
        }else{
            $res = ['code' => 502,'msg' => '获取openid失败','data' => []];
        }
        return $res;
    }
    
    
    /**
     * 用户登录（注册）并获取用户信息
     * @param Request $request
     * @author YZ
     */
    public function login(Request $request){
        $res = ['code' => 501,'msg' => '','data' => []];
        $list = self::openId($request);
        if($list['code'] == 200){
            //获取微信openid
            $openid = isset($list['data']['openid']) && $list['data']['openid'] ? $list['data']['openid'] : '';
            //根据openid查询用户信息
            //$user = DB::select('select * from sp_user where xcx_openid = ?',[$openid]);
            $user = User::where('xcx_openid','=',$openid)->first();
            if($user){
                //查询到该用户时，返回用户信息
                $data = ['userid' => $user->id,'isMobileValidate' => $user->mobile ? 1 : 0];
                $res = ['code' => 200,'msg' => '成功','data' => $data];
            }else{
                //当没有查询到该用户时，进行注册
                //$bool = DB::insert('insert into sp_user (xcx_openid,create_time) values (?,?)',[$openid,time()]);
                $orm = User::create(['xcx_openid' => $openid]);            
                if($orm){
                    $data = ['userid' => $orm->id,'isMobileValidate' => $orm->mobile ? 1 : 0];
                    $res = ['code' => 200,'msg' => '成功','data' => $data];
                }else{
                    $res = ['code' => 502,'msg' => '创建新用户失败','data' => []];
                }
            }
        }
        return $res;
    }
}
?>