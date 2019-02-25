<?php
error_reporting(0);
if(!$_POST['editsubmit']){
	$server_id = intval($_GET['server_id']);
	if (!$server_id) {
	    die('server_id wrong!');
	}
	$link = mysql_connect('localhost', 'root', '');
	if (!$link) {
	    die('Could not connect: ' . mysql_error());
	}
	mysql_query("set names utf8"); 
	$selectdb = mysql_select_db('mis', $link);
	$sql = "select * from server_tables where server_id=$server_id";
	$query = mysql_query($sql,$link);
	$server = mysql_fetch_array($query);
	mysql_close($link);
	include("edit_server.htm");
}else{
	//var_dump($_POST);
	//简单校验,对post过来的数据进行判断,看看是否为空或是否合法
	if(empty($_POST['server_serial_number'])){
		exit("server_serial_number is empty ! please input server_serial_number");
	}elseif (empty($_POST['server_serial_number'])) {
		# code...
	}

	//接受数据并处理
	$server_id = intval($_POST['server_id']);
	$server_serial_number = trim($_POST['server_serial_number']);
	$city = trim($_POST['city']);
	$idc = trim($_POST['idc']);
	$server_wan_ip = trim($_POST['server_wan_ip']);
	$server_lan_ip = trim($_POST['server_lan_ip']);
	$server_gw_ip = trim($_POST['server_gw_ip']);
	$server_device_mode = trim($_POST['server_device_mode']);
	$server_board_number = trim($_POST['server_board_number']);
	$server_cpu = trim($_POST['server_cpu']);
	$server_mem = trim($_POST['server_mem']);
	$server_disk = trim($_POST['server_disk']);
	$server_status =trim($_POST['server_status']);
	$server_pay_time = trim($_POST['server_pay_time']);
	$server_service_time = trim($_POST['server_service_time']);
	$server_msg = trim($_POST['server_msg']);
	$up_time = date("Y-m-d");

	//确认数据没问题后插入数据库
	$link = mysql_connect('localhost', 'root', '');
	if (!$link) {
	    die('Could not connect: ' . mysql_error());
	}
	mysql_query("set names utf8"); 
	$selectdb = mysql_select_db('mis', $link);
	$sql = "update server_tables set 
				idc='$idc',
				city='$city',
				server_wan_ip='$server_wan_ip',
				server_lan_ip='$server_lan_ip',
				server_gw_ip='$server_gw_ip',
				server_serial_number='$server_serial_number',
				server_device_mode='$server_device_mode',
				server_board_number='$server_board_number',
				server_cpu='$server_cpu',
				server_mem='$server_mem',
				server_disk='$server_disk',
				server_status='$server_status',
				server_pay_time='$server_pay_time',
				server_service_time='$server_service_time',
				server_msg='$server_msg' 
			where server_id = $server_id ";
	$query = mysql_query($sql,$link);
	mysql_close($link);
	header("Location: servers.php");
}
?>