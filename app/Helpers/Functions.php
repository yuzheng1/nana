<?php
//公共函数方法

/**
 * curl远程访问函数
 * @author YZ
 */
function goCurl($url,$method = 'get',$post_data = ''){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if ($method == 'post') {
        curl_setopt($ch, CURLOPT_POST, 1);
    
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    }elseif($method == 'get'){
        curl_setopt($ch, CURLOPT_HEADER, 0);
    }
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

/**
 * 获取当前时间的毫秒数
 * @author YZ
 */
function getMillisecond() {
    list($s1, $s2) = explode(' ', microtime());
    return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
}

/**
 * 获取七牛完整图片路径
 * @param string $path
 */
function getQiNiuImageUrl($path){
    $baseUrl = config('qiniu.baseUrl');
    $url = $baseUrl.ltrim($path,"/");
    return $url;
}

?>