<?php
/*
php如何连接mysql
*/

/*$link = mysql_connect('localhost', 'root', '');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
mysql_close($link);*/

/*php如何选择数据库*/
/*$link = mysql_connect('localhost', 'root', '');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$selectdb = mysql_select_db('wiki', $link);
var_dump($selectdb);
mysql_close($link);*/

/*php如何执行mysql的查询*/
/*$link = mysql_connect('localhost', 'root', '');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$selectdb = mysql_select_db('wiki', $link);
$query = mysql_query("select title from wiki_doc limit 1",$link);
var_dump($query);
mysql_close($link);*/


/*php如何获取查询到的数据*/
$link = mysql_connect('localhost', 'root', '');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
//mysql_query("set names utf8"); 
$selectdb = mysql_select_db('wiki', $link);
$query = mysql_query("select title from wiki_doc limit 10",$link);
while($doc = mysql_fetch_array($query,$link)){
	$doclist[] = $doc;
}
var_dump($doclist);
mysql_close($link);

/*php执行数据库读写分离*/
$readlink = mysql_connect('localhost', 'root', '');
//mysql_query("set names utf8"); 
$readdb = mysql_select_db('wiki', $readlink);
$readquery = mysql_query("select title from wiki_doc limit 10",$readlink);
while($doc = mysql_fetch_array($readquery,$readlink)){
	$doclist[] = $doc;
}
var_dump($doclist);

$writelink = mysql_connect('localhost', 'root', '');
//mysql_query("set names utf8"); 
$writedb = mysql_select_db('wiki', $writelink);
$writequery = mysql_query("	update wiki_doc set title='124' where did=45",$writelink);

var_dump($doclist);

?>