<?php
error_reporting(0);
$server_id = intval($_GET['server_id']);
if($server_id){
	//确认数据没问题后插入数据库
	$link = mysql_connect('localhost', 'root', '');
	if (!$link) {
	    die('Could not connect: ' . mysql_error());
	}
	mysql_query("set names utf8"); 
	$selectdb = mysql_select_db('mis', $link);
	$sql = "delete from server_tables where server_id = $server_id";
	$query = mysql_query($sql,$link);
	mysql_close($link);
	header("Location: servers.php");
}else{
	echo "server_id is wrong";
}



?>