<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../../db_info.inc.php" );
	include_once( "../../db_class.inc.php" );
	
	$where = "`Stock` > 0";
	
	if ( $deposito ) {
		$strQuery = "SELECT `ID_Pro` FROM `deposito` WHERE `ID` = '$deposito' LIMIT 1";
		if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
		if ( $objRow = mysql_fetch_object( $query, 'deposito' ) ) {
			$proveedor = $objRow->ID_Pro;
			$where = "`ID_Pro` = $proveedor";
		}
		if ( $query ) mysql_free_result( $query );
	}

	$strQuery = "SELECT `ID`, `Nombre` FROM `articulo` WHERE $where ORDER BY `ID`";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	while ( $objRow = mysql_fetch_object( $query, 'articulo' ) ) {
		echo "<option ";
		if ($articulo==$objRow->ID) echo "selected='selected' ";
		echo "value='" . $objRow->ID . "'>" . $objRow->Nombre . "</option>";
	}
	if ( $query ) mysql_free_result( $query );
?>
