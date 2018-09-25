<?php
namespace App\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: YZ
 * Date: 2018/9/25
 * Time: 16:29
 */
class SoapCotroller extends Controller{

    public function exec(){
        include app_path("WebService\Api.php");
    }
}
?>