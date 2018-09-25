<?php
/**
 * Created by PhpStorm.
 * User: YZ
 * Date: 2018/9/25
 * Time: 15:23
 */
$server = new SoapServer("Api.wsdl");
$server->setClass("Api");
$server->handle();
?>