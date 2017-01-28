<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );

	if ( !isset( $_POST[ 'ID' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$id = $_POST[ 'ID' ];
	
	$strQuery = "SELECT * FROM `proveedor` JOIN `articulo` ON (`proveedor`.`ID` = `articulo`.`ID_Pro`) WHERE `proveedor`.`ID` = '$id' LIMIT 1;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	if ( $objRow = mysql_fetch_object( $query, 'proveedor' ) ) {
		echo "X";
		exit;
	}
	$strDelete = "DELETE FROM `proveedor` WHERE `ID` = '$id'";
	if ( !$delete = mysql_query( $strDelete, $db_resource ) ) sql_err("006");
	if ( $query ) mysql_free_result( $query );
	mysql_close( $db_resource );
?>
