#phpWeJN(微江南)
江南听雨BBS微信公众平台的代码，用php实现。现在的功能非常少，欢迎同学和各路大神的贡献。   

##SAE平台
本代码在SAE平台测试通过（开通MemCache）,上传至SAE服务器时请注释掉freamwork/__sae.php文件  

##命名规则
请尽量遵守统一的命名风格，具体规则见name_rule.txt   

##Map-Room模式
嗯好吧这是我自己起的名字，为了实现微信功能的模块式添加（将其添加到功能菜单的某一层），    
具体的流程仿照wechat.el的模式：    
* 把整个应用抽象成一张大的地图   
* 每一种状态都看作一个独立的房间，房间之间有很多扇门连接   
* 进入房间时自动输出提示语，即返回给用户的信息   
* 用户的输入就是钥匙，依次与该房间的门匹配（责任链模式），如果能开启，就通过这一扇门进入下一个房间，即状态迁移（状态模式）   

就现在来说，要添加新的功能（例如在主菜单里加入一个回复Hello的功能，用户看到主菜单后输入3即可得到回复），要做的步骤有   
* 写一个继承于Room类的XXRoom类，重载其OnOpen($strKey)函数 
```php
protected function OnOpen($strKey){    
	return new TextMessage("hello");    
} 
```
* 将XXRoom注册为FirstRoom附近的Room，即在FirstRoom的SetNear()中加入    
```php
$this->NewNear("3","XXRoom");   
```   
* 在MyMap类的构造函数内注册XXRoom，即在MyMap的构造函数中加入    
```php
$this->NewRoom(new XXRoom());   
```

##API
暂时使用听雨旧站的API，请使用Provider模式以保证新听雨上线时能够方便更改API（虽然现在还未采用，仍然比较混乱）   

##What Todo
尽可能优化，规范现有的框架，为未来的开发提供一个较为健壮的基础

##编码
请小伙伴们使用UTF-8为统一编码