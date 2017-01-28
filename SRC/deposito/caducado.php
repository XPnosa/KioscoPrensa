<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );
	
	
	//BUSCAR CADUCADOS
	$strQueryDep = "SELECT `ID` FROM `deposito` WHERE `FechaCierre` < '" .date("Y-m-d H:i:s") . "' AND `Estado` = 2";
	if ( !$queryDep = mysql_query( $strQueryDep, $db_resource ) ) sql_err("003");
	while ( $objRowDep = mysql_fetch_object( $queryDep, "deposito" ) ) {
		$id = $objRowDep->ID;
		//CALCULAR IMPORTE Y ACTUALIZAR STOCK
		
		$importe = 0;
		$strQuery = "SELECT `ID_Art` FROM `art_dep` WHERE `ID_Dep` = '$id';";
		if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
		while ( $objRow = mysql_fetch_object( $query, "art_dep" ) ) {
			$articulo = $objRow->ID_Art;
			$strSubQuery = "SELECT `Recibidas`,`Vendidas` FROM `art_dep` WHERE `ID_Dep` = '$id' AND `ID_Art` = '$articulo';";
			if ( !$subQuery = mysql_query( $strSubQuery, $db_resource ) ) sql_err("003");
			if ( $objRow = mysql_fetch_object( $subQuery, "art_dep" ) ) {
				$devolver = $objRow->Recibidas - $objRow->Vendidas;
			}
			$strSubQuery2 = "SELECT `PCFinal` FROM `articulo` WHERE `ID` = '$articulo';";
			if ( !$subQuery2 = mysql_query( $strSubQuery2, $db_resource ) ) sql_err("003");
			if ( $objRow2 = mysql_fetch_object( $subQuery2, "articulo" ) ) {
				$importe = $importe + $objRow->Recibidas * $objRow2->PCFinal;
			}
			$strUpdate = "UPDATE `articulo` 
					  SET `Stock` = `Stock` - $devolver
					  WHERE `ID` = '$articulo';";
			if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
		}
		$strUpdate = "UPDATE `deposito` 
					  SET `Importe` = $importe, `Estado` = 4
					  WHERE `ID` = '$id'";
		if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
	
	}
	if ( $query ) mysql_free_result( $query );
	mysql_close( $db_resource );
?>
