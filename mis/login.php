<?php
$userlist = array("jobs"=>"111111",
					"man"=>"222222",
					"lucy"=>"333333");
if(isset($_COOKIE['user']) && isset($userlist[$_COOKIE['user']])){
	$loginuser = $_COOKIE['user'];
	echo $loginuser;
}elseif($_POST['loginsubmit']){
	if($userlist[$_POST['name']] == $_POST['password']){
		setcookie('user',$_POST['name'],time()+86400);
	}else{
		echo "input error";exit;
	}
}else{
	include "login.htm";
}	
?>