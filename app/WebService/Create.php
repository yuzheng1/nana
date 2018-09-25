<?php
/**
 * Created by PhpStorm.
 * User: YZ
 * Date: 2018/9/25
 * Time: 13:10
 */
include "Api.php";
include "SoapDiscovery.class.php";

$disc = new SoapDiscovery('Api','WebService');//api类文件名，service接口目录
$disc->getWSDL();
?>