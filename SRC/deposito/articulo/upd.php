<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../../db_info.inc.php" );
	include_once( "../../db_class.inc.php" );

	if ( !isset( $_POST[ 'Articulo' ] ) || !isset( $_POST[ 'Deposito' ] ) || !isset( $_POST[ 'Estado' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	if ( isset( $_POST[ 'Pedidas' ] ) ) $pedidas = $_POST[ 'Pedidas' ];
	if ( isset( $_POST[ 'Recibidas' ] ) ) $recibidas = $_POST[ 'Recibidas' ];
	
	$articulo = $_POST[ 'Articulo' ];
	$deposito = $_POST[ 'Deposito' ];
	$estado = $_POST[ 'Estado' ];
	
	if( $estado == 0 ) {
		$strUpdate = "UPDATE `art_dep` 
					  SET `Pedidas` = '$pedidas'
					  WHERE `ID_Dep` = '$deposito' 
					  AND `ID_Art` = '$articulo'";
		if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
	}
	
	if( $estado == 1 ) {
		$strUpdate = "UPDATE `art_dep` 
					  SET `Recibidas` = '$recibidas'
					  WHERE `ID_Dep` = '$deposito' 
					  AND `ID_Art` = '$articulo'";
		if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
	}
	
	mysql_close( $db_resource );
?>
