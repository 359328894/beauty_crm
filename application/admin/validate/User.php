<?php

namespace app\admin\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        'mobile'  => '/^1[3-8]{1}[0-9]{9}$/'
    ];
    /**
     * 提示消息
     */
    protected $message = [
        'mobile'     => '手机格式不正确',
    ];
    /**
     * 验证场景
     */
    protected $scene = [
        'add'  => [],
        'edit' => [],
    ];
    
}
