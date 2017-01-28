<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<H1>Debe activar las cookies para usar esta aplicacion</H1>";
		exit( 1 );
	}	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	include_once( "../../db_info.inc.php" );
	include_once( "../../db_class.inc.php" );

	if ( !isset( $_POST[ 'Articulo' ] ) || !isset( $_POST[ 'Deposito' ] ) || !isset( $_POST[ 'Pedidas' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$articulo = $_POST[ 'Articulo' ];
	$pedidas = $_POST[ 'Pedidas' ];
	$deposito = $_POST[ 'Deposito' ];
	
	$strInsert = "INSERT INTO `art_dep` (`ID_Art`, `ID_Dep`, `Pedidas`)
				  VALUES ( '$articulo', '$deposito', '$pedidas');";
	if ( !$insert = mysql_query( $strInsert, $db_resource ) ) sql_err("004");
?>
