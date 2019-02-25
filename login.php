<?php
error_reporting(0);
$userlist = array("jobs"=>'111111','rick'=>'000000');

if(isset($_POST['loginsubmit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$keeptime = $_POST['keeptime'];
	//username
	//var_dump(isset($userlist[$username]));exit;
	if(isset($userlist[$username]) && $userlist[$username] === $password){
		setcookie("username",$username,time()+$keeptime*86400);
		header("Location: serverinfo.php");
	}else{
		echo "username or password error";
		include "login.htm";
	}
	
}else{
	include "login.htm";
}


?>