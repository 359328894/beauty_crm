<?php

namespace app\admin\model;

use think\Model;

class CustomerLog extends Model
{
    // 表名
    protected $name = 'customer_log';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    // 追加属性
    protected $append = [

    ];

    public function admin()
    {
        return $this->belongsTo('Admin', 'admin_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
