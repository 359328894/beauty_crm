<?php

namespace app\admin\model;

use think\Model;

class UserThird extends Model
{
    // 表名
    protected $name = 'user_third';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'status_text'
    ];
    

    
    public function getStatusList()
    {
        return ['1' => __('Status 1'),'2' => __('Status 2'),'0' => __('Status 0')];
    }     


    public function getStatusTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }




    public function relation()
    {
        return $this->belongsTo('UserRelation', 'relation_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
