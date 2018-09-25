<?php
namespace App\Http\Controllers\Api;

require app_path("Libs/qiniu/php-sdk/autoload.php");

use App\Http\Controllers\Controller;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use App\Service\ImageService;



/**
 * 图片处理控制器
 * @author YZ
 *
 */
class ImageController extends Controller{
    
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    
    }
    
    /**
     * 上传图片
     * @param unknown $file
     * @author YZ
     */
    public function upLoad(Request $request){
        $res = ['code' => 501,'msg' => '','data' => []];
        //获取上传文件的扩展名
        $extend_arr = explode('.', $file);
        $extend = $extend_arr[count($extend_arr)-1];
        if(!in_array($extend, array('jpg','JPG','jpeg','JPEG','png','PNG','gif','GIF'))){
            $res = ['code' => 502,'msg' => '非法的图片格式','data' => []];
        }else{
            $accessKey = config("qiniu.AccessKey");
            $secretKey = config("qiniu.SecretKey");
            $bucket = config("qiniu.bucket");
            //构建鉴权对象
            $auth = new Auth($accessKey, $secretKey);
            //生成上传 Token
            $token = $auth->uploadToken($bucket);
            //上传到七牛后保存的文件名
            $key = getMillisecond().'.'.$extend;
            //初始化 UploadManager 对象并进行文件的上传。
            $uploadMgr = new UploadManager();
            //调用 UploadManager 的 putFile 方法进行文件的上传。
            list($ret, $err) = $uploadMgr->putFile($token, $key, $file);
            if ($err !== null) {
                $res = ['code' => 503,'msg' => '图片上传失败','data' => []];
            } else {
                $res = ImageService::getInstance()->saveImage($p_id, $ret['key']);
            }
        }        
        return response()->json($res);
    }
}

?>