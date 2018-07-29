# 毕业设计


## 1 思维导图

### 1.1 文档导图

![](https://blogimags.charmingkamly.cn/1-graduation-project/1.1.png)

```php
<? php
    echo '234';
    echo "234";
>
```

### 1.2 产品导图

#### 小程序

![](https://blogimags.charmingkamly.cn/1-graduation-project/1.2.png)

## 2 最终效果

### 2.1 PC用户侧

![](https://blogimags.charmingkamly.cn/1-graduation-project/2.1.mp4)

### 2.2 PC管理侧

todo  需要录制视频

### 2.3 小程序用户侧

![](https://blogimags.charmingkamly.cn/1-graduation-project/2.3.mp4)

## 3 亮点

### 3.1 自动化配置环境脚本

 系统服务架构基于 LNMP(LinuxNginxMySQLPHP)，Redis，ELKF(Elasticsearch Logstash Kibana Filebeta) 监控系统， Redis 缓存， Supervisor 进程管理工具。

如果这些软件的部署都采用人工手动安装，那可是一个巨大无比的工程。

因此我在开发中一直在思考，如何快捷方便配置统一的服务器环境？

所以在搭建云服务器的系统的环境，使用了自己编写的自动化构建环境脚本，减少了开发人员搭建环境的复杂流程，尽量做到输入一个命令，喝着咖啡等待环境的安装成功提示。

该脚本只需要输入相应的选项即可顺利安装所需要的软件（目前包含 PHP , MySQL , Nginx , Redis , Elasticsearch , Logstash , Kibana , Filebeta）。

相关的脚本已经上传到github中，欢迎大家来给个[stars](https://github.com/kamly/automated-operation)~

在这里不详细述说其开发经历和使用方式，在其他文章(待更新)将会详细介绍，目前先看着[readme.md](https://github.com/kamly/automated-operation/blob/master/README.md)吧。

### 3.2 自动化部署应用脚本

在公司的开发流程中，让我印象深刻的是我同样能喝着咖啡等待应用部署，只需要点个按钮就能发布到线上环境。

其原理很简单，不仅仅使用git对代码进行版本管理，最重要是通过github提供的webhook服务，将master分支的相关变动推送到设定的服务器中，接着自动化部署脚本实时进行监控相应的请求。

这样子便可以坐着喝咖啡等待，脚本自动将最新的远端master分支拉取到服务器，然后进行应用的部署~

相关的脚本也已经上传到github中，欢迎大家来给个[stars](https://github.com/kamly/github-webhooks)~

在这里也不详细述说其开发经历和使用方式，在其他文章(待更新)将会详细介绍，目前先看着[readme.md](https://github.com/kamly/github-webhook/blob/master/README.md)吧。

### 3.3 Laravel5.4.36

PC端用户侧 和 PC端管理侧 服务架构于 Laravel5.4.36 框架

利用框架的特点：
1. 后端模板渲染， 权限判断， 邮件发送
2. 使用 redis消息队列， elasticsearch搜索引擎， des，aes加密方式
3. 模型查询
4. 自定义命令行

具体代码上传至[github](https://github.com/kamly/graduation-zd-web)，欢迎大家拍砖，哈哈哈~

### 3.4 ThinkPHP5.0

小程序用户侧 服务架构于 ThinkPHP5.0 框架

利用Thinkphp5框架的特点：
1. 封装 小程序加解密接口，七牛云上传图片接口， Html转Json的接口
2. 使用 redis消息队列， elasticsearch搜索引擎， des，aes加密方式
3. 使用 异常捕获， 参数检测， 命令类， 接口版本
4. 模型查询
5. 日志记录

基于Thinkphp5框架设计了能够快速开发小程序后台的架构，其特性是：
1. 拥有清晰目录结构
2. 统一的日志记录
3. 全局的异常拦截能力
4. 完善的数据校验体系
5. 安全可靠的token机制

具体代码上传至[github](https://github.com/kamly/graduation-zd-app)，欢迎大家拍砖，哈哈哈~

### 3.5 WePY


微信小程序基于Wepy框架开发，框架的作者融入了vue等现有前端框架的语法风格和特性，因此开发者可以用vue的开发思维进行小程序开发

我在此基础上，引入了wepy-redux作为数据状态管理，让体验流程如斯顺滑。

为了方便自己开发，我封装了一些类。比如：1. 日志上报类；2. 封装原生 获取信息，跳转，网络，提示

利用WePY框架的组件特性，组件化了Loading组件，让用户体验提高了一个新的层次。

具体代码上传至[github](https://github.com/kamly/graduation-wepy-zd)，欢迎大家拍砖，哈哈哈~


### 3.5 监控

如何提供更多维度的产品数据或者提供给开发者更详细的系统状态数据？

可以借鉴腾讯移动分析或者谷歌分析的系统，因此我在自动化构建系统的时候搭建了ELKF的日志分析系统。

Elasticsearch作为日志搜索引擎，Logstash作为日志上报工具，Filebeat作为日志收集工具，Kibana提供可视化操作页面。

这样不仅可以集中化管理日志，还可以实现查询，排序，统计等功能，从多个维度进行产品分析，制定更好的运营策略。

这样不仅可以实现产品数据的查询，排序，统计，从多个维度进行产品分析，定制更好的运营策略，还可以集中化管理系统中产生的日志数据，可以做到实时监控系统的运行状态，及时作出相应的调整。

具体效果：

![](https://blogimags.charmingkamly.cn/1-graduation-project/3.5.1.png)

![](https://blogimags.charmingkamly.cn/1-graduation-project/3.5.2.png)

![](https://blogimags.charmingkamly.cn/1-graduation-project/3.5.3.png)

## 6 总结

### 6.1 docker 

### 6.2 备份

### 6.3 域名规划


## 7 杂项

### 7.1 PPT

[PPT](https://github.com/kamly/blog_note/blob/master/work/1-graduation-project/doc/%E6%AF%95%E8%AE%BE%E7%AD%94%E8%BE%A9.key)

### 7.2 论文

[论文](https://github.com/kamly/blog_note/blob/master/work/1-graduation-project/doc/%20%E6%AF%95%E8%AE%BE%E8%AE%BA%E6%96%87.pdf)
