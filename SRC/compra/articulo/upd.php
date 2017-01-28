<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../../db_info.inc.php" );
	include_once( "../../db_class.inc.php" );

	if ( !isset( $_POST[ 'Articulo' ] ) || !isset( $_POST[ 'Compra' ] ) || !isset( $_POST[ 'OLD' ] ) || !isset( $_POST[ 'NEW' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$compra = $_POST[ 'Compra' ];
	$articulo = $_POST[ 'Articulo' ];
	$old = $_POST[ 'OLD' ];
	$new = $_POST[ 'NEW' ];
	$dif = $new - $old;
	
	//OBTENER DEPOSITO
	if ( $dif == 0 ) exit;
	if ( $dif > 0 ) {
		$strQuery = "SELECT `ID` FROM `deposito`
					JOIN `art_dep` ON (`ID` = `ID_Dep`)
					WHERE `ID_Art` = '$articulo' AND `Estado` IN (2,5)
					AND ( `Vendidas` + $dif ) <= `Recibidas` ORDER BY `FechaCierre` LIMIT 1";
		if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
		if ( $objRow = mysql_fetch_object( $query, "deposito" ) ) {	
			$deposito = $objRow->ID;
		}else{
			echo "X";
			exit;
		}
	}else{
		$strQuery = "SELECT `ID` FROM `deposito`
					JOIN `art_dep` ON (`ID` = `ID_Dep`)
					WHERE `ID_Art` = '$articulo' AND `Estado` IN (2,5)
					AND ( `Vendidas` + $dif ) >= 0 ORDER BY `FechaCierre` LIMIT 1";
		if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
		if ( $objRow = mysql_fetch_object( $query, "deposito" ) ) {	
			$deposito = $objRow->ID;
		}else{
			echo "Y";
			exit;
		}
	}
	
	//OBTENER IMPORTE
	$strSubQuery = "SELECT `PVP` FROM `articulo` WHERE `ID` = '$articulo';";
	if ( !$subQuery = mysql_query( $strSubQuery, $db_resource ) ) sql_err("003");
	if ( $objRow = mysql_fetch_object( $subQuery, "articulo" ) ) {
		$importe = $dif * $objRow->PVP;
	}
	
	//ACTUALIZAR UNIDADES VENDIDAS
	$strUpdate = "UPDATE `art_dep`
				  SET `Vendidas` = `Vendidas` + $dif
				  WHERE `ID_Art` = '$articulo' AND `ID_Dep` = '$deposito'";
	if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
	
	//ACTUALIZAR STOCK
	$strUpdate = "UPDATE `articulo`
				  SET `Stock` = `Stock` - $dif
				  WHERE `ID` = '$articulo'";
	if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
	
	//ACTUALIZAR IMPORTE COMPRA
	$strUpdate = "UPDATE `compra`
				  SET `Importe` = `Importe` + $importe
				  WHERE `ID` = '$compra'";
	if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
	
	//ACTUALIZAR LINEA DE COMPRA
	$strUpdate = "UPDATE `art_com` 
				  SET `Unidades` = $new
				  WHERE `ID_Art` = '$articulo' AND `ID_Com` = '$compra'";
	if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("004");
	
	if ( $query ) mysql_free_result( $query );
	
	mysql_close( $db_resource );
?>
