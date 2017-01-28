<?php 
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	if ( !isset( $_POST[ "ID" ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );
	
	$id = $_POST[ "ID" ];
	
	$strQuery = "SELECT `Importe` FROM `compra` WHERE `ID` = $id;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	if ( $objRow = mysql_fetch_object( $query, "compra" ) ){
		$import = $objRow->Importe;
		echo "<input type='text' id='import' value = '$import' style='display:none' />";
		echo "<label id='importe'>Importe: " . number_format($import,2) . "</label><br />";
	}
	
	$strQuery = "SELECT * FROM `art_com` WHERE `ID_Com` = $id;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	if ( !mysql_num_rows ( $query ) ) { 
		echo ""; 
		mysql_close( $db_resource );
		exit;
	}
	$strQuery = "SELECT * FROM `art_com` WHERE `ID_Com` = $id;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	echo "<br /><table border='1'>";
	echo "<thead style='background-color:#BCA'><tr>";
	echo "<th style='width:75%'>Articulo</th>";
	echo "<th style='width:25%'>Unidades</th>";
	echo "</tr></thead>";
	while ( $objRow = mysql_fetch_object( $query, "art_com" ) ) {
		echo "<tr>";
		$strSubQuery = "SELECT `Nombre` FROM `articulo` WHERE `ID` = '" . $objRow->ID_Art . "' LIMIT 1;";
		if ( !$subQuery = mysql_query( $strSubQuery, $db_resource ) ) sql_err("003");
		if ( mysql_num_rows($subQuery) ){
			$subObjRow = mysql_fetch_object( $subQuery, "articulo" );
			echo "<th>" . $subObjRow->Nombre . "</th>";
		}else echo "<th>" . $objRow->ID_Art . "</th>";
		echo "<th>" . $objRow->Unidades . "</th>";
		echo "<th><img style='cursor: pointer' src='./img/delx.gif' onclick=\"Ven.delArtVen('$id', '".$objRow->ID_Art."', '".$objRow->Unidades."' )\" ></img></th>";
		echo "</tr>";
	}
	echo "</table>";
	if ( $query ) mysql_free_result( $query );
	if ( $subQuery ) mysql_free_result( $subQuery );
	mysql_close( $db_resource );
?>
