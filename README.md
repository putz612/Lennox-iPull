Lennox-iPull
============

Data logger for Lennox iComfort thermostats.  This is a simple set of PHP scripts to pull information from the your Lennox iComfort account.

Requirements
--------------

To use iPull you will need to aquire a copy of the PHP HTTPFUL PHAR file from http://phphttpclient.com/downloads/httpful.phar

Setup
--------------

Create a config.php file useing the example below 

<?php
$uri = "https://services.myicomfort.com/DBAcessService.svc/";
$username="";
$password="";
$serialnumber="";
?>

If you don't know your thermostat serial number just enter in your iComfort username and password and run the GetSystemSerials.php to get a list of all serial numbers under your account.


