<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );

	if ( !isset( $_POST[ 'CIF' ] ) || !isset( $_POST[ 'Nombre' ] ) || !isset( $_POST[ 'Direccion' ] ) || !isset( $_POST[ 'Telefono' ] ) || !isset( $_POST[ 'Mail' ] ) || !isset( $_POST[ 'Comentario' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$cif = $_POST[ 'CIF' ];
	$nombre = $_POST[ 'Nombre' ];
	$direccion = $_POST[ 'Direccion' ];
	$telefono = $_POST[ 'Telefono' ];
	$mail = $_POST[ 'Mail' ];
	$comentario = $_POST[ 'Comentario' ];
	
	$strInsert = "INSERT INTO `proveedor` (`CIF`, `Nombre`, `Direccion`, `Telefono`, `Mail`, `Comentario`)
				  VALUES ('$cif', '$nombre', '$direccion', '$telefono', '$mail', '$comentario');";
	if ( !$insert = mysql_query( $strInsert, $db_resource ) ) sql_err("004");
	mysql_close( $db_resource );
?>
