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
	
	include_once( "../../db_info.inc.php" );
	include_once( "../../db_class.inc.php" );
	
	$id = $_POST[ "ID" ];
	
	$strQuery = "SELECT * FROM `art_com` WHERE `ID_Com` = $id;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	if ( !mysql_num_rows ( $query ) ) { 
		echo "No se encontraron datos."; 
		mysql_close( $db_resource );
		exit;
	}
	$strQuery = "SELECT * FROM `art_com` WHERE `ID_Com` = $id;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	echo "<table border='1'>";
	echo "<thead style='background-color:#ABC'><tr>";
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
		echo "<th><img style='cursor: pointer' src='./img/edit.gif' onclick=\"Com.Art.editArtCom('$id', '".$objRow->ID_Art."', '".$objRow->Unidades."' )\" ></img></th>";
		echo "<th><img style='cursor: pointer' src='./img/delx.gif' onclick=\"Com.Art.delArtCom('$id', '".$objRow->ID_Art."', '".$objRow->Unidades."' )\" ></img></th>";
		echo "</tr>";
	}
	echo "</table>";
	if ( $query ) mysql_free_result( $query );
	if ( $subQuery ) mysql_free_result( $subQuery );
	mysql_close( $db_resource );
?>
