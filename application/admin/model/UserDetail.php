<?php

namespace app\admin\model;

use think\Model;

class UserDetail extends Model
{

    // 表名
    protected $name = 'user_group';
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    // 追加属性
    protected $append = [
        'status_text'
    ];

    public function getStatusList()
    {
        return ['normal' => __('Normal'), 'hidden' => __('Hidden')];
    }

    public function getStatusTextAttr($value, $data)
    {

        $value = $value ? $value : $data['status'];
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }
    public function userGroup()
    {
        return $this->belongsTo('UserGroup', 'group_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
    public function store()
    {
        return $this->belongsTo('Store', 'store_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }

    public function admin()
    {
        return $this->belongsTo('Admin', 'admin_ids', 'username', [], 'LEFT')->setEagerlyType(0);
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
