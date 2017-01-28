<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../../db_info.inc.php" );
	include_once( "../../db_class.inc.php" );

	if ( !isset( $_POST[ 'Articulo' ] ) || !isset( $_POST[ 'Deposito' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$articulo = $_POST[ 'Articulo' ];
	$deposito = $_POST[ 'Deposito' ];
	
	$strDelete = "DELETE FROM `art_dep` WHERE `ID_Dep` = '$deposito' AND `ID_Art` = '$articulo'";
	if ( !$delete = mysql_query( $strDelete, $db_resource ) ) sql_err("006");
	mysql_close( $db_resource );
?>
