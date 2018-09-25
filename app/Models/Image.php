<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 图片表
 * @author YZ
 */
class Image extends Model
{
    //表名
    protected $table = 'image';
    
    //自定义时间字段
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
        
    //时间戳格式
    protected $dateFormat = 'U';
    
    //不能被批量赋值的属性/黑名单
    protected $guarded = [];
}
