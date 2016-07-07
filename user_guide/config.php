<?php
$host = "dtdb-dev.chibwsimd7gb.ap-southeast-1.rds.amazonaws.com:3306";
$dbuser ="dtuser";
$db_password ="Ze5rewefEc";
$database="dogytales";
mysql_connect($host,$dbuser,$db_password) or die ("Error connecting to DB");
	$selectDb=mysql_select_db($database) ;	
	if($selectDb)
	{
		echo "successfully done";	
	}

?>
