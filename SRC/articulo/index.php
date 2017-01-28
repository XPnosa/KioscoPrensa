<?php 
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );

	$whereStock = "1";
	$whereProveedor = "1";
	
	if ( isset( $_POST[ "Find" ] ) ) {
		if ( !isset( $_POST[ "SubSec" ] ) ){
			echo "<h1>Invocación incorrecta del script.</h1>";
			exit;
		}
		$find = true;
		$ssec = $_POST[ "SubSec" ];
		if ( $ssec == "compra" ) $whereStock = "`Stock` > 0";
		else {
			if ( !isset( $_POST[ "ID" ] ) ){
				echo "<h1>Invocación incorrecta del script.</h1>";
				exit;
			}
			$id = $_POST[ "ID" ];
			$strQuery = "SELECT `ID_Pro` FROM `deposito` WHERE `ID` = '$id' LIMIT 1;";
			if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
			$objRow = mysql_fetch_object( $query, 'deposito' );
			$proveedor = $objRow->ID_Pro;
			if ( $query ) mysql_free_result( $query );
			$whereProveedor = "`ID_Pro` = '$proveedor'";
		}
	}
	

	if ( !isset( $_POST[ "Nombre" ] ) ) {
		$nombre = "";
	}else{
		$nombre = $_POST[ "Nombre" ];
	}
	
	$seccion = "articulo";
	
	$strQuery = "SELECT * FROM `articulo` WHERE `Nombre` LIKE '%$nombre%' AND $whereStock AND $whereProveedor ORDER BY `ID` DESC LIMIT 10;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	if ( !mysql_num_rows ( $query ) ) { 
		echo "No se encontraron datos."; 
		mysql_close( $db_resource );
		exit;
	}
	echo "<table border='1'>";
	if ( $_SESSION[ "BGCOLOR" ] && !$find ) echo "<thead style='background-color:#CBA'><tr>";
	else echo "<thead style='background-color:#ABC'><tr>";
	echo "<th style='width:5%'>ID</th>";
	echo "<th style='width:20%'>Nombre</th>";
	echo "<th style='width:20%'>Familia</th>";
	echo "<th style='width:20%'>Proveedor</th>";
	echo "<th style='width:5%'>Stock</th>";
	echo "<th style='width:5%'>P.C. Base</th>";
	echo "<th style='width:5%'>P.C. Fianl</th>";
	echo "<th style='width:5%'>PVP</th>";
	echo "<th style='width:15%'>Comentario</th>";
	echo "</tr></thead>";
	while ( $objRow = mysql_fetch_object( $query, $seccion ) ) {
		echo "<tr>";
		echo "<th>" . $objRow->ID . "</th>";
		echo "<th>" . $objRow->Nombre . "</th>";
		$strSubQuery = "SELECT `Nombre` FROM `familia` WHERE `ID` = '" . $objRow->ID_Fam . "' LIMIT 1;";
		if ( !$subQuery = mysql_query( $strSubQuery, $db_resource ) ) sql_err("003");
		if ( mysql_num_rows($subQuery) ){
			$subObjRow = mysql_fetch_object( $subQuery, "familia" );
			if ( $find ) echo "<th>" . $subObjRow->Nombre . "</th>";
			else echo "<th style='cursor: pointer' onclick=\"listar('familia','" . $subObjRow->Nombre . "')\">" . $subObjRow->Nombre . "</th>";
		}else echo "<th>" . $objRow->ID_Fam . "</th>";
		$strSubQuery = "SELECT `Nombre` FROM `proveedor` WHERE `ID` = '" . $objRow->ID_Pro . "' LIMIT 1;";
		if ( !$subQuery = mysql_query( $strSubQuery, $db_resource ) ) sql_err("003");
		if ( mysql_num_rows($subQuery) ){
			$subObjRow = mysql_fetch_object( $subQuery, "proveedor" );
			if ( $find ) echo "<th>" . $subObjRow->Nombre . "</th>";
			else echo "<th style='cursor: pointer' onclick=\"listar('proveedor','" . $subObjRow->Nombre . "')\">" . $subObjRow->Nombre . "</th>";
		}else echo "<th>" . $objRow->ID_Pro . "</th>";
		echo "<th>" . $objRow->Stock . "</th>";
		echo "<th>" . number_format($objRow->PCBase, 2) . "</th>";
		echo "<th>" . number_format($objRow->PCFinal, 2) . "</th>";
		echo "<th>" . number_format($objRow->PVP, 2) . "</th>";
		echo "<th>" . $objRow->Comentario . "</th>";
		if ( $find ) {
			echo "<th><img style='cursor: pointer' src='./img/plus.gif' onclick=\"window.opener.seleccionar('".$objRow->Nombre."','slcArticulo')\" ></img></th>";
		}else{
			echo "<th><img style='cursor: pointer' src='./img/edit.gif' onclick=\"Art.editArt('".$objRow->ID."')\" ></img></th>";
			echo "<th><img style='cursor: pointer' src='./img/delx.gif' onclick=\"Art.delArt('".$objRow->ID."')\" ></img></th>";
		}
		echo "</tr>";
	}
	echo "</table>";
	if ( $query ) mysql_free_result( $query );
	if ( $subQuery ) mysql_free_result( $subQuery );
	mysql_close( $db_resource );
?>
