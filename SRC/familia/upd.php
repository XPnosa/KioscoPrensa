<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );

	if ( !isset( $_POST[ 'ID' ] ) || !isset( $_POST[ 'Nombre' ] ) || !isset( $_POST[ 'IVA' ] ) || !isset( $_POST[ 'RecEq' ] ) || !isset( $_POST[ 'Comentario' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$id = $_POST[ 'ID' ];
	$nombre = $_POST[ 'Nombre' ];
	$iva = $_POST[ 'IVA' ];
	$receq = $_POST[ 'RecEq' ];
	$comentario = $_POST[ 'Comentario' ];
	
	$strUpdate = "UPDATE `familia` 
				  SET `Nombre` = '$nombre', `IVA` = $iva, `RecEq` = $receq, `Comentario` = '$comentario'
				  WHERE `ID` = '$id'";
	if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
	
	
	$strQuery = "SELECT `ID`, `PCBase` FROM `articulo` WHERE `ID_Fam` LIKE '$id'";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	while ( $objRow = mysql_fetch_object( $query, 'articulo' ) ) {
		$idart = $objRow->ID;
		$pcbase = $objRow->PCBase;
		$pcfinal = $pcbase + $pcbase * ( $iva + $receq ) / 100;
		$strUpdate = "UPDATE `articulo` SET `PCFinal` = $pcfinal WHERE `ID` = '$idart'";
		if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
	}
	if ( $query ) mysql_free_result( $query );
	
	mysql_close( $db_resource );
?>
