<?php

namespace app\admin\model;

use think\Model;

class Admin extends Model
{
    // 表名
    protected $name = 'admin';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    
    // 追加属性
    protected $append = [

    ];
    

    
    public function getStatusList()
    {
        return ['1' => __('在职'),'0' => __('离职')];
    }     


    public function getLogintimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['logintime']) ? $data['logintime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getStatusTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setLogintimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }


    public function store()
    {
        return $this->belongsTo('Store', 'store_ids', 'id', [], 'LEFT')->setEagerlyType(0);
    }
    public function customerLog()
    {
        return $this->belongsTo('\app\admin\model\CustomerLog',  'id', 'admin_id',[], 'LEFT')->setEagerlyType(0);
    }
}
