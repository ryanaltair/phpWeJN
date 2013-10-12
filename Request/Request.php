<?php
/*
 * Request类基类，用于访问网络资源并解析返回
 * 该类为抽象类，应该被继承
 */
abstract class Request{

	protected $OutArray;	//传出的数据,二维数组Array[数据名]=数据
	/*
	 * 传入调用Request时需要的参数

	 * 该方法应该被重载，用于返回请求的数据
	 * @param Array $inArray传入的数据，请于具体的Request子类中注明传入数据的格式
	 * @return Array传出的数据，请于具体的Request子类中注明传出数据的格式
	 */
	abstract public function doRequest($inArray);
	
}
?>