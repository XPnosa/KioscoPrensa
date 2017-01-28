<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );

	if ( !isset( $_POST[ 'ID' ] ) || !isset( $_POST[ 'DNI' ] ) || !isset( $_POST[ 'Nombre' ] ) || !isset( $_POST[ 'Direccion' ] ) || !isset( $_POST[ 'Telefono' ] ) || !isset( $_POST[ 'Mail' ] ) || !isset( $_POST[ 'Comentario' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$id = $_POST[ 'ID' ];
	$dni = $_POST[ 'DNI' ];
	$nombre = $_POST[ 'Nombre' ];
	$direccion = $_POST[ 'Direccion' ];
	$telefono = $_POST[ 'Telefono' ];
	$mail = $_POST[ 'Mail' ];
	$comentario = $_POST[ 'Comentario' ];
	
	$strUpdate = "UPDATE `cliente` 
				  SET `DNI` = '$dni', `Nombre` = '$nombre', `Direccion` = '$direccion', `Telefono` = '$telefono', `Mail` = '$mail', `Comentario` = '$comentario'
				  WHERE `ID` = '$id'";
	if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
	mysql_close( $db_resource );
?>
