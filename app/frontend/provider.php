<?php

use app\frontend\exception\Exception;//应用异常注入

// 容器Provider定义文件
return [
    'think\exception\Handle' => Exception::class,
];
