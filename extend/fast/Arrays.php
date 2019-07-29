<?php

namespace fast;

class Arrays
{
    public  function arraysToString($array)
    {
        /**
         *
         *  将二维数组转为字符串
         * @param array $array 要转换的数组
         * @return string      转换得到的字符串
         * @access public
         *
         **/
        $t ='' ;
        foreach ($array as $v) {
            $v = join("/",$v); // 可以用implode将一维数组转换为用逗号连接的字符串，join是别名
            $temp[] = $v;
        }
        foreach ($temp as $v) {
            $t.=$v."/";
        }
        $t = substr($t, 0, -1); // 利用字符串截取函数消除最后一个逗号
        return $t;
    }


}
