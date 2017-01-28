<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );
	
	
	//BUSCAR PROXIMOS CIERRES
	if ( date("Y-m-d") . " 18:00:00" > date("Y-m-d H:i:s")  ) exit;
	
	$_SESSION[ "BGCOLOR" ] = false;
	
	$strQueryDep = "SELECT `ID` FROM `deposito` WHERE ADDDATE(`FechaCierre`,-1) < '" .date("Y-m-d H:i:s") . "' AND `Estado` = 2";
	if ( !$queryDep = mysql_query( $strQueryDep, $db_resource ) ) sql_err("003");
	while ( $objRowDep = mysql_fetch_object( $queryDep, "deposito" ) ) {
		$id = $objRowDep->ID;
		$_SESSION[ "BGCOLOR" ] = true;
		echo "<center><label style='cursor: pointer' onclick='listar(\"deposito\",null,null,null,null,null,null,null,null,null,null,$id);'>El deposito #$id caduca hoy </label></center>";
	}
	if ( $query ) mysql_free_result( $query );
	mysql_close( $db_resource );
?>
