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
	
	$strQuery = "SELECT `Estado` FROM `deposito` WHERE `deposito`.`ID` = '$id' LIMIT 1;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	if ( $objRow = mysql_fetch_object( $query, 'deposito' ) ) {
		$estado = $objRow->Estado;
		if ( $estado ) {
			echo "X";
			exit;
		}
	}
	$strDelete = "DELETE FROM `art_dep` WHERE `ID_Dep` = '$id'";
	if ( !$delete = mysql_query( $strDelete, $db_resource ) ) sql_err("006");
	$strDelete = "DELETE FROM `deposito` WHERE `ID` = '$id'";
	if ( !$delete = mysql_query( $strDelete, $db_resource ) ) sql_err("006");
	if ( $query ) mysql_free_result( $query );
	mysql_close( $db_resource );
?>
