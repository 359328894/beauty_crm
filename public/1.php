<?php


$arr=[
    ['id'=>'1','name'=> '张三'],
    ['id'=>'2','name'=>'李四'],
];
echo $json=JSON($arr);
$array=json_decode($json);
print_r($array);

