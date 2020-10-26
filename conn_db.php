<?php 

function conn_db(){
	$link = new mysqli("Your Host", 'User Name', 'PWD', 'DBName');
	$link->set_charset("utf8");
	if ($link->connect_error) {
		die("Failed Connection!".$link->connect_error);
	}
	return $link;
}

?>