<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );

	if ( !isset( $_POST[ 'Nombre' ] ) || !isset( $_POST[ 'IVA' ] ) || !isset( $_POST[ 'RecEq' ] ) || !isset( $_POST[ 'Comentario' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$nombre = $_POST[ 'Nombre' ];
	$iva = $_POST[ 'IVA' ];
	$receq = $_POST[ 'RecEq' ];
	$comentario = $_POST[ 'Comentario' ];
	
	$strInsert = "INSERT INTO `familia` (`Nombre`, `IVA`, `RecEq`, `Comentario`)
				  VALUES ('$nombre', $iva, $receq, '$comentario');";
	if ( !$insert = mysql_query( $strInsert, $db_resource ) ) sql_err("004");
	mysql_close( $db_resource );
?>
