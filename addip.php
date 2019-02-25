<?php
error_reporting(0);
if(!$_COOKIE['username']){
	header("Location: login.php");
	exit;
}
//获取ip列表
$mysqllink  = mysql_connect("localhost:3306","root","");
mysql_select_db("nagios",$mysqllink);
$sql = "select ip,auth from ipinfo where status=1 ";
$query = mysql_query($sql);
while($data = mysql_fetch_array($query)){
	$iplist[$data['ip']]=$data['auth'];
}

if(!isset($_POST['addipsubmit'])){
	include "addip.htm";
}else{
	$ip = trim($_POST['ip']);
	$auth = trim($_POST['auth']);
	
	//对数据校验
	if(!preg_match("/^([0-9]{1,3}\.){3}[0-9]{1,3}$/i",$ip)){
		exit("ip error");
	}
	if(!preg_match("/^\w+$/i",$auth)){
		exit("auth error");
	}
	
	$mysqllink = mysql_connect("localhost:3306","root","");
	mysql_select_db("nagios");
	$sql = "select id from ipinfo where ip='$ip'";
	$query = mysql_query($sql);
	if(mysql_fetch_array($query)){
		exit("ip exists");
	}
	
	$sql = "insert into ipinfo (ip,auth,status) values ('$ip','$auth',1)";
	$query = mysql_query($sql);
	if(!$query){
		exit("sql error");
	}
	header("Location: serverinfo.php");
	
}




?>