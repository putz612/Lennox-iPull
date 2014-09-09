<?php
require_once('config.php');
include('httpful.phar');

$request = $uri . "GetSystemsInfo?UserId=" . $username;
$r = \Httpful\Request::get($request)
	->authenticateWith($username, $password)
	->sendIt();

//echo $r
$systeminfo=json_decode($r, true);

#var_dump($systeminfo);
#echo $systeminfo["Systems"]["0"]["Gateway_SN"];
foreach ($systeminfo["Systems"] as $systems) {
	echo "Gateway SN\tSystem Name\n";
	echo "---------------------------\n";
	echo $systems["Gateway_SN"] . "\t" . $systems["System_Name"] . "\n";
}


?>

