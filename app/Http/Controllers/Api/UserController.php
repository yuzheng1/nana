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
//         $this->validate($request, [
//             'code' => 'required',
//         ]);        
        $service = UserService::getInstance();
        $data = $service->openId($request);
        if($data){
            $res = ['code' => 200,'msg' => '成功','data' => $data];
        }
        return response()->json($res);
    }
}