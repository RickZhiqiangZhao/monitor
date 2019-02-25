<?php
//验证
$key = $_POST['key'];
if($key == 123456789){
	//接受数据
	$javanum = $_POST['javanum'];
	$phpnum = $_POST['phpnum'];
	$ip = $_POST['ip'];
	
	//过滤和校验
	$javanum =intval($javanum);
	if(xxxx){
		file_put_contents("error.log","data error :$javanum",FILE_APPEND);
		
	}
	
	//其他的校验
	
	//入库
	$time= time();
	$mysqllink = mysql_connect("localhost:3306","root","");
	mysql_select_db("nagios",$mysqllink);
	$sql = "insert into snmpinfo (ip,pname,pvalue,ptype,punits,ptime) values ('$ip','javanum','$javanum','curl',' ','$time') ";
	$query = mysql_query($sql);
	
}else{
	//写入日志
	file_put_contents("error.log","auth error :$key",FILE_APPEND);
}



?>