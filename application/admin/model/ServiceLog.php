<?php

namespace app\admin\model;

use think\Model;

class ServiceLog extends Model
{
    // 表名
    protected $name = 'service_log';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    
    // 追加属性
    protected $append = [
        'starttime_text',
        'endtime_text'
    ];

    public function getStarttimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['starttime']) ? $data['starttime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getEndtimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['endtime']) ? $data['endtime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setStarttimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }

    protected function setEndtimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }


    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }


    public function admin()
    {
        return $this->belongsTo('Admin', 'admin_ids', 'username', [], 'LEFT')->setEagerlyType(0);
    }


    public function store()
    {
        return $this->belongsTo('Store', 'store_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
    public function serviceItems()
    {
        return $this->belongsTo('\app\admin\model\service\Items', 'service_items_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
    public function commentLog()
    {
        return $this->belongsTo('\app\admin\model\CommentLog', 'service_items_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
    public function customerLog()
    {
        return $this->belongsTo('\app\admin\model\CustomerLog', 'admin_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
