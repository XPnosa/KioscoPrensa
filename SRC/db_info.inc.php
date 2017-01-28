<?php
	date_default_timezone_set('Europe/Paris');
	
	$db_resource = mysql_connect( "localhost", $_SESSION[ "User" ], $_SESSION[ "Pass" ] );
	if (!$db_resource) sql_err("001");
	
	$connect = mysql_select_db( "jespinosap_kiosco", $db_resource );
	if (!$connect) sql_err("002");
	
	function sql_err($err) {
		echo "Se ha producido un error. codigo: $err";
		$fichero = fopen( "./log/error.txt", "a+" );
		fwrite( $fichero, date("d-m-Y H:i:s") . " - Error $err: \r\n+ " . mysql_error() . "\r\n" );
		fclose( $fichero );
		exit;
	}
?>
