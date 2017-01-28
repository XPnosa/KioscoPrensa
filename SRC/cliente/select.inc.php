<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );

	$strQuery = "SELECT `ID`, `Nombre` FROM `cliente` ORDER BY `ID`";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	while ( $objRow = mysql_fetch_object( $query, 'cliente' ) ) {
		echo "<option ";
		if ($cliente==$objRow->ID) echo "selected='selected' ";
		echo "value='" . $objRow->ID . "'>" . $objRow->Nombre . "</option>";
	}
	if ( $query ) mysql_free_result( $query );
?>
