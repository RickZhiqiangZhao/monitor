<?php
error_reporting(0);
$link = mysql_connect('localhost', 'root', '');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_query("set names utf8"); 
$selectdb = mysql_select_db('nagios', $link);
$sql = "select * from server_tables ";
$query = mysql_query($sql,$link);
while($data = mysql_fetch_array($query)){
	$serverlist[] = $data; 
}
mysql_close($link);
//var_dump($serverlist);exit;
include("serverinfo.htm");
?>