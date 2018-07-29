# 博客文章

## 简介

博客的文章使用git作为版本管理

每当发生主分支的修改，服务器有相应的脚本进行文章的更新

主要逻辑：

1. push master
2. webhooks
3. 服务器脚本定时监控
4. php脚本更新文章 


## 配置

vim script/config.php

```php
<?php 

$config = [
    'db' => [
        'dbname' => 'xxx',
        'username' => 'xxx',
        'password' => 'xxx',
        'host' => 'xxx.xxx.xxx.xxx',
        'port' => 'xxx',
    ]
];
```


## index.php 脚本使用


```bash

# php script/index.php [--pull/-p]  --method/-m [all/select/need] --type/-t [article/work] --name/-n [name]

# -p 拉取最新代码
# -m 方法
# -t 类型
# -n 名字

php script/index.php -m all # 全部更新

php script/index.php -p -m select -t work -n 1-test -t work -n 2-test # 拉取最新代码 更新 work/1-test/1-test.md work/2-test/2-test.md

```

## 定时任务脚本使用

具体使用方法，参考[github-webhooks](https://github.com/kamly/github-webhooks)使用PHP消耗任务

核心命令如下

```bash
cd /data/www/spare.charmingkamly.cn/blog_note

git pull origin master

php script/index.php -m all
```

## todo

1. 目前只能针对性更新md
2. 日志监控

