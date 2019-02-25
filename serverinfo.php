<?php
error_reporting(0);


if(!$_COOKIE['username']){
	header("Location: login.php");
	exit;
}

$ipaddr = trim($_REQUEST['ip']);
if(!preg_match("/^([0-9]{1,3}\.){3}[0-9]{1,3}$/i",$ipaddr)){
	$ipaddr = '127.0.0.1';
}
$pname = trim($_GET['pname']);
if(!$pname){
	$pname = '5 minute Load';
}
//获取ip列表
$mysqllink  = mysql_connect("localhost:3306","root","");
mysql_select_db("nagios",$mysqllink);
$sql = "select ip,auth from ipinfo where ip like '%".$_POST['ip']."%' and status=1 ";
//echo $sql;exit;
$query = mysql_query($sql);
while($data = mysql_fetch_array($query)){
	$iplist[$data['ip']]=$data['auth'];
}

//获取某ip下某个snmp信息
$sql = "select * from snmpinfo where ip='$ipaddr' and pname='$pname'";
$query = mysql_query($sql);
while($data = mysql_fetch_array($query)){
	if($data['pname'] == '15 minute Load'){
		$lineorarea = 'area';
	}else{
		$lineorarea = 'line';
	}
	$xcategory[] = date("Y-m-d H:i:s" ,$data['ptime']);
	$pvaluedata[] = $data['pvalue'];
	$snmpinfolist[]=$data;
}

$xcategory = implode("','",$xcategory);
$pvaluedata = implode(",",$pvaluedata);

//获取某ip下所有的snmp信息（最近一次抓取的）
$sql = "SELECT * FROM  `snmpinfo` WHERE ip =  '$ipaddr' AND ptime = ( SELECT MAX( ptime ) FROM snmpinfo WHERE ip ='$ipaddr' )";

$query = mysql_query($sql);
while($data = mysql_fetch_array($query)){
	
	$infolist[] = $data;
}




include "serverinfo.htm";


?>