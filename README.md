
# yii2-redlock

A redlock for Yii2, distributed locks with Redis

Based on [Redlock-rb](https://github.com/antirez/redlock-rb) by [Salvatore Sanfilippo](https://github.com/antirez) and [signe redlock-php](https://github.com/signe/redlock-php)

## Installation

To install run:
```
    composer require "msheng/yii2-redlock:~1.0.0"
```
Or add this line to *require* section of composer.json:
```
    "msheng/yii2-redlock": "~1.0.0"
```


## project

Your project need to be an [yii2-app-advanced](https://github.com/yiisoft/yii2-app-advanced) , and here is the [guide](https://github.com/yiisoft/yii2-app-advanced/blob/master/docs/guide/start-installation.md)

## main.php

In common/config/main.php or main-local.php

```PHP
<?php
'components' => [
    'redLock' => [
        'class' => 'msheng\RedLock\RedLock',
        'servers' => [
            [
                'hostname' => '127.0.0.1',
                'port' => 6379,
                'timeout' => 0.5,
            ],
            [
                'hostname' => '127.0.0.1',
                'port' => 6389,
                'timeout' => 0.5,
            ],
            [
                'hostname' => '127.0.0.1',
                'port' => 6399,
                'timeout' => 0.5,
            ]
        ]
    ]
],
```

## Usage

```PHP
<?php
$lock = Yii::$app->redLock->lock('hello');
if($lock){
    sleep(10);
    Yii::$app->redLock->unlock($lock);
}
```

