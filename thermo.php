<?php

require_once('config.php');
include('httpful.phar');


class Tstat
{

	private $SerialNumber;
	private $uri;
	private $username;
	private $password;

	function __construct($uri, $username, $password, $SerialNumber) {
		$this->uri = $uri;
		$this->username = $username;
		$this->password = $password;
		$this->SerialNumber = $SerialNumber;
	}

	public function GetHeatSet() {
		$systemInfo=$this->GetTStatInfo();
		return $systemInfo["tStatInfo"]["0"]["Heat_Set_Point"];
	}

	public function GetCoolSet() {
		$systemInfo=$this->GetTStatInfo();
		return $systemInfo["tStatInfo"]["0"]["Cool_Set_Point"];
	}

	public function GetIndoorTemp() {
		$systemInfo=$this->GetTStatInfo();
		return $systemInfo["tStatInfo"]["0"]["Indoor_Temp"];
	}

	public function GetIndoorHumidity() {
		$systemInfo=$this->GetTStatInfo();
		return $systemInfo["tStatInfo"]["0"]["Indoor_Humidity"];
	}

	private function GetTStatInfo() {
		$request = $this->uri . "GetTStatInfoList?GatewaySN=" . $this->SerialNumber . "&TempUnit=&Cancel_Away=-1";
		$r = \Httpful\Request::get($request)
			->authenticateWith($this->username, $this->password)
			->sendIt();
		$systeminfo=json_decode($r, true);
		return $systeminfo;

	}		
}

$home = new Tstat($uri, $username, $password, $serialnumber);

echo $home->GetHeatSet();

?>
