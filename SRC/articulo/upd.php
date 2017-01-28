<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );

	if ( !isset( $_POST[ 'ID' ] ) || !isset( $_POST[ 'Nombre' ] ) || !isset( $_POST[ 'Familia' ] ) || !isset( $_POST[ 'Proveedor' ] ) || !isset( $_POST[ 'PCBase' ] ) || !isset( $_POST[ 'PVP' ] ) || !isset( $_POST[ 'Comentario' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$id = $_POST[ 'ID' ];
	$nombre = $_POST[ 'Nombre' ];
	$familia = $_POST[ 'Familia' ];
	$proveedor = $_POST[ 'Proveedor' ];
	$pcbase = $_POST[ 'PCBase' ];
	$pvp = $_POST[ 'PVP' ];
	$comentario = $_POST[ 'Comentario' ];
	
	$strQuery = "SELECT `IVA`, `RecEq` FROM `familia` WHERE `familia`.`ID` LIKE '$familia' LIMIT 1;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	if ( $objRow = mysql_fetch_object( $query, 'familia' ) ) {
		$pcfinal = $pcbase + $pcbase * ($objRow->IVA + $objRow->RecEq)/100;
		if ( $pcfinal > $pvp ) {
			echo "warning\n";
			exit;
		}
	}
	
	$strUpdate = "UPDATE `articulo` 
				  SET `Nombre` = '$nombre', `ID_Fam` = $familia, `ID_Pro` = $proveedor, `PCBase` = $pcbase, `PCFinal` = $pcfinal, `PVP` = $pvp, `Comentario` = '$comentario'
				  WHERE `ID` = '$id'";
	if ( !$update = mysql_query( $strUpdate, $db_resource ) ) sql_err("005");
	if ( $query ) mysql_free_result( $query );
	mysql_close( $db_resource );
?>
