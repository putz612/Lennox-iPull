<?php

require_once('config.php');
include('httpful.phar');


class Tstat
{

	private $SerialNumber;
	private $uri;
	private $username;
	private $password;
	protected $HeatSet;
	protected $CoolSet;
	protected $IndoorTemp;
	protected $IndoorHumidity;
	protected $ts;

	function __construct($uri, $username, $password, $SerialNumber) {
		$this->uri = $uri;
		$this->username = $username;
		$this->password = $password;
		$this->SerialNumber = $SerialNumber;
		$this->UpdateData();
	}

	public function __get($name) {
		return isset($this->$name) ? $this->$name : null;
	}

	private function UpdateData() {
		$request = $this->uri . "GetTStatInfoList?GatewaySN=" . $this->SerialNumber . "&TempUnit=&Cancel_Away=-1";
		$r = \Httpful\Request::get($request)
			->authenticateWith($this->username, $this->password)
			->sendIt();
		$systemInfo=json_decode($r, true);
		$this->HeatSet = $systemInfo["tStatInfo"]["0"]["Heat_Set_Point"];
		$this->CoolSet = $systemInfo["tStatInfo"]["0"]["Cool_Set_Point"];
		$this->IndoorTemp = $systemInfo["tStatInfo"]["0"]["Indoor_Temp"];
		$this->IndoorHumidity = $systemInfo["tStatInfo"]["0"]["Indoor_Humidity"];
		$this->ts = substr($systemInfo["tStatInfo"]["0"]["DateTime_Mark"], 6,10);
		$this->ts = new DateTime("@$this->ts");
	}		
}

$home = new Tstat($uri, $username, $password, $serialnumber);

echo $home->ts->format('Y-m-d H:i:s');

?>
