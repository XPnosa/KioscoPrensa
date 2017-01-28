<?php 
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );
	
	if ( !isset( $_POST[ "ID" ] ) ) $whereid=1;
	else $whereid = "`ID` = " . $_POST[ "ID" ];
	
	if ( !isset( $_POST[ "FechaP1" ] ) || !isset( $_POST[ "FechaP2" ] ) ) {
		$whereP = "1";
	}else{
		$fechaP1 = $_POST[ "FechaP1" ];
		$fechaP2 = $_POST[ "FechaP2" ];
		$whereP = "`FechaPedido` BETWEEN '$fechaP1' AND '$fechaP2'";
	}
	
	if ( !isset( $_POST[ "FechaD1" ] ) || !isset( $_POST[ "FechaD2" ] ) ) {
		$whereD = "1";
	}else{
		$fechaD1 = $_POST[ "FechaD1" ];
		$fechaD2 = $_POST[ "FechaD2" ];
		$whereD = "`FechaDeposito` BETWEEN '$fechaD1' AND '$fechaD2'";
	}
	
	if ( !isset( $_POST[ "FechaC1" ] ) || !isset( $_POST[ "FechaC2" ] ) ) {
		$whereC = "1";
	}else{
		$fechaC1 = $_POST[ "FechaC1" ];
		$fechaC2 = $_POST[ "FechaC2" ];
		$whereC = "`FechaCierre` BETWEEN '$fechaC1' AND '$fechaC2'";
	}
	
	if ( !isset( $_POST[ "Proveedor" ] ) ) {
		$whereR = "1";
	}else{
		$proveedor = $_POST[ "Proveedor" ];
		$whereR = "`ID_Pro` = '$proveedor'";
	}
	
	$seccion = "deposito";
	
	$strQuery = "SELECT * FROM `deposito` WHERE $whereid AND $whereR AND $whereP AND $whereD AND $whereC ORDER BY `ID` DESC LIMIT 10;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	if ( !mysql_num_rows ( $query ) ) { 
		echo "No se encontraron datos."; 
		mysql_close( $db_resource );
		exit;
	}
	echo "<table border='1'>";
	if ( $_SESSION[ "BGCOLOR" ] ) echo "<thead style='background-color:#CBA'><tr>";
	else echo "<thead style='background-color:#ABC'><tr>";
	echo "<th style='width:5%'>ID</th>";
	echo "<th style='width:20%'>Proveedor</th>";
	echo "<th style='width:5%'>Importe</th>";
	echo "<th style='width:10%'>Estado</th>";
	echo "<th style='width:15%'>Fecha Pedido</th>";
	echo "<th style='width:15%'>Fecha Deposito</th>";
	echo "<th style='width:15%'>Fecha Cierre</th>";
	echo "<th style='width:15%'>Comentario</th>";
	echo "</tr></thead>";
	while ( $objRow = mysql_fetch_object( $query, $seccion ) ) {
		echo "<tr>";
		echo "<th>" . $objRow->ID . "</th>";
		$strSubQuery = "SELECT `Nombre` FROM `proveedor` WHERE `ID` = '" . $objRow->ID_Pro . "' LIMIT 1;";
		if ( !$subQuery = mysql_query( $strSubQuery, $db_resource ) ) sql_err("003");
		if ( mysql_num_rows($subQuery) ){
			$subObjRow = mysql_fetch_object( $subQuery, "proveedor" );
			echo "<th style='cursor: pointer' onclick=\"listar('proveedor','" . $subObjRow->Nombre . "')\">" . $subObjRow->Nombre . "</th>";
		}else echo "<th>" . $objRow->ID_Pro . "</th>";
		echo "<th>" . number_format($objRow->Importe, 2) . "</th>";
		
		$estado = ( $objRow->Estado == 5 ? 'Imperecedero' : ( $objRow->Estado == 4 ? 'Caducado' : ( $objRow->Estado == 3 ? 'Cerrado' : ( $objRow->Estado == 2 ? 'Recibido' : ( $objRow->Estado == 1 ? 'Pedido' : 'Sin procesar') ) ) ) );
		
		echo "<th>" . $estado . "</th>";
		echo "<th>" . $objRow->FechaPedido . "</th>";
		echo "<th>" . $objRow->FechaDeposito . "</th>";
		echo "<th>" . $objRow->FechaCierre . "</th>";
		echo "<th>" . $objRow->Comentario . "</th>";
		echo "<th><img style='cursor: pointer' src='./img/edit.gif' onclick=\"Dep.editDep('".$objRow->ID."')\" ></img></th>";
		echo "<th><img style='cursor: pointer' src='./img/delx.gif' onclick=\"Dep.delDep('".$objRow->ID."')\" ></img></th>";
		echo "<th><img style='cursor: pointer' src='./img/plus.gif' onclick=\"buscarArticulos('deposito', '".$objRow->ID."', '".$objRow->Estado."')\" ></img></th>";
		echo "</tr>";
	}
	echo "</table>";
	if ( $query ) mysql_free_result( $query );
	if ( $subQuery ) mysql_free_result( $subQuery );
	mysql_close( $db_resource );
?>
