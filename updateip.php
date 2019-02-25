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


$ipaddr = trim($_GET['ip']);
if(!preg_match("/^([0-9]{1,3}\.){3}[0-9]{1,3}$/i",$ipaddr)){
	exit("ip error");
}

if($_GET['edittype'] == 'delete'){
	$mysqllink = mysql_connect("localhost:3306","root","");
	mysql_select_db("nagios");
	
	$sql = "update ipinfo set status=0 where ip = '$ipaddr'";
	//echo $sql;exit;
	$query = mysql_query($sql);
	if(!$query){
		exit("sql error");
	}
	header("Location: serverinfo.php");
}else{
	if(!isset($_POST['editipsubmit'])){
		$sql = "select ip,auth from ipinfo where ip='$ipaddr' ";
		$query = mysql_query($sql);
		$ipinfo = mysql_fetch_array($query);
		include "editip.htm";
	}else{
		$ip = trim($_POST['ip']);
		$auth = trim($_POST['auth']);
		$ipold = $_GET['ip'];
		
		//对数据校验
		if(!preg_match("/^([0-9]{1,3}\.){3}[0-9]{1,3}$/i",$ip)){
			exit("ip error");
		}
		if(!preg_match("/^\w+$/i",$auth)){
			exit("auth error");
		}
		
		$mysqllink = mysql_connect("localhost:3306","root","");
		mysql_select_db("nagios");
		
		$sql = "update ipinfo set ip = '$ip',auth = '$auth' where ip = '$ipold'";
		//echo $sql;exit;
		$query = mysql_query($sql);
		if(!$query){
			exit("sql error");
		}
		header("Location: serverinfo.php");
		
	}
}



?>