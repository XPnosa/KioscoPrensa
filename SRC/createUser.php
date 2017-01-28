<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
		exit( 1 );
	}
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "./db_info.inc.php" );

	if ( !isset( $_POST[ 'User' ] ) || !isset( $_POST[ 'Pass' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$user = $_POST[ 'User' ];
	$pass = $_POST[ 'Pass' ];
	
	$strQuery = "GRANT ALL ON jespinosap_kiosco.* TO $user@localhost IDENTIFIED BY '$pass'";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("007");
	mysql_close( $db_resource );
?>
