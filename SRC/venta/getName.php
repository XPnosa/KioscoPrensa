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
	if ( !$id ) $id=0;
	
	$strQuery = "SELECT `Nombre`, `Stock` FROM `articulo` WHERE `ID` = $id";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	if ( $objRow = mysql_fetch_object( $query, "articulo" ) ) $nombre = $objRow->Nombre . " [Stock: " . $objRow->Stock . "]";
	else $nombre = "";
	
	echo $nombre;
	
	if ( $query ) mysql_free_result( $query );
	mysql_close( $db_resource );
?>
