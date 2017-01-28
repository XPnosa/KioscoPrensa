<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );
	
	$strInsert = "INSERT INTO `compra` (`ID_Cli`, `Fecha`, `Importe`, `Comentario`)
				  VALUES ( 1 , NOW(), 0, '' );";
	if ( !$insert = mysql_query( $strInsert, $db_resource ) ) sql_err("004");
	
	$strQuery = "SELECT MAX(`ID`) AS ID FROM `compra`";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	if ( $objRow = mysql_fetch_object( $query, "compra" ) ) $id = $objRow->ID;
	
	echo $id;
	
	if ( $query ) mysql_free_result( $query );
	mysql_close( $db_resource );
?>
