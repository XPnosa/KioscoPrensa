<?php 
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );
	
	if ( !isset( $_POST[ "Fecha1" ] ) || !isset( $_POST[ "Fecha2" ] ) ) {
		$whereF = "1";
	}else{
		$fecha1 = $_POST[ "Fecha1" ];
		$fecha2 = $_POST[ "Fecha2" ];
		$whereF = "`Fecha` BETWEEN '$fecha1' AND '$fecha2'";
	}
	
	if ( !isset( $_POST[ "Cliente" ] ) ) {
		$whereC = "1";
	}else{
		$cliente = $_POST[ "Cliente" ];
		$whereC = "`ID_Cli` = '$cliente'";
	}
	
	$seccion = "compra";
	
	$strQuery = "SELECT * FROM `compra` WHERE $whereC AND $whereF ORDER BY `ID` DESC LIMIT 10;";
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
	echo "<th style='width:20%'>Cliente</th>";
	echo "<th style='width:40%'>Fecha</th>";
	echo "<th style='width:20%'>Importe</th>";
	echo "<th style='width:15%'>Comentario</th>";
	echo "</tr></thead>";
	while ( $objRow = mysql_fetch_object( $query, $seccion ) ) {
		echo "<tr>";
		echo "<th>" . $objRow->ID . "</th>";
		$strSubQuery = "SELECT `Nombre` FROM `cliente` WHERE `ID` = '" . $objRow->ID_Cli . "' LIMIT 1;";
		if ( !$subQuery = mysql_query( $strSubQuery, $db_resource ) ) sql_err("003");
		if ( mysql_num_rows($subQuery) ){
			$subObjRow = mysql_fetch_object( $subQuery, "cliente" );
			echo "<th style='cursor: pointer' onclick=\"listar('cliente','" . $subObjRow->Nombre . "')\">" . $subObjRow->Nombre . "</th>";
		}else echo "<th>" . $objRow->ID_Cli . "</th>";
		echo "<th>" . $objRow->Fecha . "</th>";
		echo "<th>" . number_format($objRow->Importe, 2) . "</th>";
		echo "<th>" . $objRow->Comentario . "</th>";
		echo "<th><img style='cursor: pointer' src='./img/edit.gif' onclick=\"Com.editCom('".$objRow->ID."')\" ></img></th>";
		echo "<th><img style='cursor: pointer' src='./img/delx.gif' onclick=\"Com.delCom('".$objRow->ID."')\" ></img></th>";
		echo "<th><img style='cursor: pointer' src='./img/plus.gif' onclick=\"buscarArticulos('compra', '".$objRow->ID."')\" ></img></th>";
		echo "</tr>";
	}
	echo "</table>";
	if ( $query ) mysql_free_result( $query );
	if ( $subQuery ) mysql_free_result( $subQuery );
	mysql_close( $db_resource );
?>
