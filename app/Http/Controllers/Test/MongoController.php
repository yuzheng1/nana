<?php
namespace App\Http\Controllers\Test;
use App\Http\Controllers\Controller;

/**
 * Created by PhpStorm.
 * User: YZ
 * Date: 2018/9/19
 * Time: 13:24
 */
Class MongoController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * 测试
     */
    public function dbTest(){
        $db = new \MongoDB\Driver\Manager("mongodb://47.100.105.163:27017");

    }
}