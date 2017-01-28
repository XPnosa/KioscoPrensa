<?php
if ( !isset( $_COOKIE ) ) {
	echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
	exit( 1 );
}
session_id( $_COOKIE[ "Kiosco" ] );
session_start();
?>
<?php
	if ( !isset( $_POST[ 'User' ] ) || !isset( $_POST[ 'Pass' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$_SESSION[ "User" ] = $_POST[ 'User' ];
	$_SESSION[ "Pass" ] = $_POST[ 'Pass' ];
	
	include_once( "./db_info.inc.php" );
?>
