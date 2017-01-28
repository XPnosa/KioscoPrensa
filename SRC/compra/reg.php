<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );

	if ( !isset( $_POST[ 'Cliente' ] ) || !isset( $_POST[ 'Comentario' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$cliente = $_POST[ 'Cliente' ];
	$comentario = $_POST[ 'Comentario' ];
	
	$strInsert = "INSERT INTO `compra` (`ID_Cli`, `Fecha`, `Importe`, `Comentario`)
				  VALUES ( $cliente, NOW(), 0, '$comentario');";
	if ( !$insert = mysql_query( $strInsert, $db_resource ) ) sql_err("004");
	
	if ( $query ) mysql_free_result( $query );
	mysql_close( $db_resource );
?>
