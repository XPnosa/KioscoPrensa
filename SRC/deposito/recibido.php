<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );

	if ( !isset( $_POST[ 'ID' ] ) || !isset( $_POST[ 'Fecha' ] ) || !isset( $_POST[ 'Check' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$id = $_POST[ 'ID' ];
	$fecha = $_POST[ 'Fecha' ];
	$check = $_POST[ 'Check' ];
	
	if ( $check == 'true' ) {
		$strUpdate = "UPDATE `deposito` 
				  SET `FechaDeposito` = NOW(), `Estado` = '5'
				  WHERE `ID` = '$id'";
		if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
	}else{
		if ( date("Y-m-d H:i:s") > "$fecha 23:59:59" ) {
			echo "warning";
			exit;
		}
		$strUpdate = "UPDATE `deposito` 
				  SET `FechaDeposito` = NOW(), `FechaCierre` = '$fecha 23:59:59', `Estado` = '2'
				  WHERE `ID` = '$id'";
		if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
	}
	
	//ACTUALIZAR STOCK [E IMPORTE]
	
	$importe = 0;
	$strQuery = "SELECT `ID_Art` FROM `art_dep` WHERE `ID_Dep` = '$id';";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	while ( $objRow = mysql_fetch_object( $query, "art_dep" ) ) {
		$articulo = $objRow->ID_Art;
		$strSubQuery = "SELECT `Recibidas` FROM `art_dep` WHERE `ID_Dep` = '$id' AND `ID_Art` = '$articulo';";
		if ( !$subQuery = mysql_query( $strSubQuery, $db_resource ) ) sql_err("003");
		if ( $objRow = mysql_fetch_object( $subQuery, "art_dep" ) ) {
			$recibidas = $objRow->Recibidas;
		}
		$strUpdate = "UPDATE `articulo` 
				  SET `Stock` = `Stock` + $recibidas
				  WHERE `ID` = '$articulo';";
		if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
		if ( $check == 'true' ){
			$strSubQuery = "SELECT `PCFinal` FROM `articulo` WHERE `ID` = '$articulo';";
			if ( !$subQuery = mysql_query( $strSubQuery, $db_resource ) ) sql_err("003");
			if ( $objRow = mysql_fetch_object( $subQuery, "articulo" ) ) {
				$importe = $importe + $recibidas * $objRow->PCFinal;
			}
		}
	}
	if ( $check == 'true' ){
		$strUpdate = "UPDATE `deposito` 
				  SET `Importe` = $importe
				  WHERE `ID` = '$id'";
		if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
	}
	if ( $query ) mysql_free_result( $query );
	if ( $subQuery ) mysql_free_result( $subQuery );
	mysql_close( $db_resource );
?>
