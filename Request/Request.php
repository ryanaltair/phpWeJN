<?php
/*
 * Request类基类，用于访问网络资源并解析返回
 * 该类为抽象类，应该被继承
 */
abstract class Request{
	protected $InArray;		//传入的数据，二维数组Array[参数名]=参数
	protected $OutArray;	//传出的数据,二维数组Array[数据名]=数据
	/*
	 * 传入调用Request时需要的参数
	 * @param Array $inArray传入的数据，请于具体的Request子类中注明传入数据的格式
	 */
	public function setRequest($inArray){
		$this->InArray=$inArray;
	}
	//处理Request，该方法应被重载
	abstract protected function Process();
	
	/*
	 * 该方法应该被重载，用于返回请求的数据
	 * @return 传出的数据，请于具体的Request子类中注明传出数据的格式
	 */
	public function getRequest(){
		$this->Process();
		return $this->OutArray;
		 
	}
	
}
?>