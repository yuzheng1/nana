<?php
namespace App\Http\Controllers\Api;

use App\Service\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 用户控制器
 * @author YZ
 *
 */
class UserController extends Controller{
    
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }  
    
    /**
     * 获取小程序openId
     * @param code 获取openid的code
     * @return json
     * @author YZ
     */
    public function openId(Request $request){
        $res = ['code' => 501,'msg' => '','data' => []];
        //参数校验
        $this->validate($request, [
            'code' => 'required',
        ]);
        $res = UserService::getInstance()->openId($request);        
        return response()->json($res);
    }
    
    /**
     * 用户登录（注册）并获取用户信息
     * @param code 获取openid的code
     * @return json
     * @author YZ
     */
    public function login(Request $request){
        $res = ['code' => 501,'msg' => '','data' => []];
        //参数校验
        $this->validate($request, [
            'code' => 'required',
        ]);
        $res = UserService::getInstance()->login($request);
        return response()->json($res);
    }
}