<?php
//��֤
$key = $_POST['key'];
if($key == 123456789){
	//��������
	$javanum = $_POST['javanum'];
	$phpnum = $_POST['phpnum'];
	$ip = $_POST['ip'];
	
	//���˺�У��
	$javanum =intval($javanum);
	if(xxxx){
		file_put_contents("error.log","data error :$javanum",FILE_APPEND);
		
	}
	
	//������У��
	
	//���
	$time= time();
	$mysqllink = mysql_connect("localhost:3306","root","");
	mysql_select_db("nagios",$mysqllink);
	$sql = "insert into snmpinfo (ip,pname,pvalue,ptype,punits,ptime) values ('$ip','javanum','$javanum','curl',' ','$time') ";
	$query = mysql_query($sql);
	
}else{
	//д����־
	file_put_contents("error.log","auth error :$key",FILE_APPEND);
}



?>