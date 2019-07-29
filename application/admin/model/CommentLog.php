<?php

namespace app\admin\model;

use think\Model;

class CommentLog extends Model
{
    // 表名
    protected $name = 'comment_log';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'level_text'
    ];
    

    
    public function getLevelList()
    {
        return ['good' => __('Good'),' medium' => __(' medium'),'bad' => __('Bad')];
    }     


    public function getLevelTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['level']) ? $data['level'] : '');
        $list = $this->getLevelList();
        return isset($list[$value]) ? $list[$value] : '';
    }




    public function admin()
    {
        return $this->belongsTo('Admin', 'admin_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
