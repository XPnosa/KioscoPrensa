<?php 
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	if ( !isset( $_POST[ "ID" ] ) || !isset( $_POST[ "State" ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	include_once( "../../db_info.inc.php" );
	include_once( "../../db_class.inc.php" );
	
	$id = $_POST[ "ID" ];
	$estado = $_POST[ "State" ];
	
	$strQuery = "SELECT * FROM `art_dep` WHERE `ID_Dep` = $id;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	if ( !mysql_num_rows ( $query ) ) { 
		echo "No se encontraron datos."; 
		mysql_close( $db_resource );
		exit;
	}
	echo "<table border='1'>";
	echo "<thead style='background-color:#ABC'><tr>";
	echo "<th style='width:40%'>Articulo</th>";
	echo "<th style='width:15%'>Unidades Pedidas</th>";
	echo "<th style='width:15%'>Unidades Recibidas</th>";
	echo "<th style='width:15%'>Unidades Vendidas</th>";
	echo "<th style='width:15%'>Unidades Devueltas</th>";
	echo "</tr></thead>";
	while ( $objRow = mysql_fetch_object( $query, "art_dep" ) ) {
		echo "<tr>";
		$strSubQuery = "SELECT `Nombre` FROM `articulo` WHERE `ID` = '" . $objRow->ID_Art . "' LIMIT 1;";
		if ( !$subQuery = mysql_query( $strSubQuery, $db_resource ) ) sql_err("003");
		if ( mysql_num_rows($subQuery) ){
			$subObjRow = mysql_fetch_object( $subQuery, "articulo" );
			echo "<th>" . $subObjRow->Nombre . "</th>";
		}else echo "<th>" . $objRow->ID_Art . "</th>";
		echo "<th>" . $objRow->Pedidas . "</th>";
		echo "<th>" . $objRow->Recibidas . "</th>";
		echo "<th>" . $objRow->Vendidas . "</th>";
		echo "<th>" . $objRow->Devolver . "</th>";
		if ( $estado < 2 ) { //PEDIDO O SIN PROCESAR
			echo "<th><img style='cursor: pointer' src='./img/edit.gif' onclick=\"Dep.Art.editArtDep('$id', '".$objRow->ID_Art."', $estado)\" ></img></th>";
			if ( $estado < 1 ) { // SIN PROCESAR
				echo "<th><img style='cursor: pointer' src='./img/delx.gif' onclick=\"Dep.Art.delArtDep('$id', '".$objRow->ID_Art."')\" ></img></th>";
			}
		}
		echo "</tr>";
	}
	echo "</table>";
	if ( $query ) mysql_free_result( $query );
	if ( $subQuery ) mysql_free_result( $subQuery );
	mysql_close( $db_resource );
?>
