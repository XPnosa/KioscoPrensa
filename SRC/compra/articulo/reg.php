<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../../db_info.inc.php" );
	include_once( "../../db_class.inc.php" );

	if ( !isset( $_POST[ 'Articulo' ] ) || !isset( $_POST[ 'Compra' ] ) || !isset( $_POST[ 'Pedidas' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$compra = $_POST[ 'Compra' ];
	$pedidas = $_POST[ 'Pedidas' ];
	$articulo = $_POST[ 'Articulo' ];
	
	//COMPROBAR ARTICULO
	$strQuery = "SELECT `ID_Art` FROM `art_com`
				WHERE `ID_Art` = '$articulo' AND `ID_Com` = '$compra'";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	if ( $objRow = mysql_fetch_object( $query, "art_com" ) ) {
		echo "Y";
		exit;
	}
	
	//OBTENER DEPOSITO
	$strQuery = "SELECT `ID` FROM `deposito`
				JOIN `art_dep` ON (`ID` = `ID_Dep`)
				WHERE `ID_Art` = '$articulo' AND `Estado` IN (2,5)
				AND ( `Vendidas` + $pedidas ) <= `Recibidas` ORDER BY `FechaCierre` LIMIT 1";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	if ( $objRow = mysql_fetch_object( $query, "deposito" ) ) {	
		$deposito = $objRow->ID;
	}else{
		echo "X";
		exit;
	}
	
	//OBTENER IMPORTE
	$strSubQuery = "SELECT `PVP` FROM `articulo` WHERE `ID` = '$articulo';";
	if ( !$subQuery = mysql_query( $strSubQuery, $db_resource ) ) sql_err("003");
	if ( $objRow = mysql_fetch_object( $subQuery, "articulo" ) ) {
		$importe = $pedidas * $objRow->PVP;
	}
	
	//ACTUALIZAR UNIDADES VENDIDAS
	$strUpdate = "UPDATE `art_dep`
				  SET `Vendidas` = `Vendidas` + $pedidas
				  WHERE `ID_Art` = '$articulo' AND `ID_Dep` = '$deposito'";
	if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
	
	//ACTUALIZAR STOCK
	$strUpdate = "UPDATE `articulo`
				  SET `Stock` = `Stock` - $pedidas
				  WHERE `ID` = '$articulo'";
	if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
	
	//ACTUALIZAR IMPORTE COMPRA
	$strUpdate = "UPDATE `compra`
				  SET `Importe` = `Importe` + $importe
				  WHERE `ID` = '$compra'";
	if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
	
	//AÑADIR LINEA DE COMPRA
	$strInsert = "INSERT INTO `art_com` (`ID_Art`, `ID_Com`, `Unidades`)
				  VALUES ( '$articulo', '$compra', '$pedidas');";
	if ( !$insert = mysql_query( $strInsert, $db_resource ) ) sql_err("004");
	
	if ( $query ) mysql_free_result( $query );
	
	mysql_close( $db_resource );
?>
