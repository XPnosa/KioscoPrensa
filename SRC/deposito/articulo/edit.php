<?php
if ( !isset( $_COOKIE ) ) {
	echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
	exit( 1 );
}
session_id( $_COOKIE[ "Kiosco" ] );
session_start();
?>
<?php
	if ( !isset( $_POST[ 'ID_Dep' ] ) || !isset( $_POST[ 'ID_Art' ] ) || !isset( $_POST[ 'Estado' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	include_once( "../../db_info.inc.php" );
	include_once( "../../db_class.inc.php" );
	
	$deposito = $_POST[ 'ID_Dep' ];
	$articulo = $_POST[ 'ID_Art' ];
	$estado = $_POST[ 'Estado' ];
	
	if ( $estado == 0 ){
		$strQuery = "SELECT `Pedidas` FROM `art_dep` WHERE `ID_Dep` = '$deposito' AND `ID_Art` = '$articulo' LIMIT 1;";
		if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
		$objRow = mysql_fetch_object( $query, "art_dep" );
		$pedidas = $objRow->Pedidas;
		if ( $query ) mysql_free_result( $query );
	}else{
		$strQuery = "SELECT `Recibidas` FROM `art_dep` WHERE `ID_Dep` = '$deposito' AND `ID_Art` = '$articulo' LIMIT 1;";
		if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
		$objRow = mysql_fetch_object( $query, "art_dep" );
		$recibidas = $objRow->Recibidas;
		if ( $query ) mysql_free_result( $query );
	}
	
	$strQuery = "SELECT `Nombre` FROM `articulo` WHERE `ID` = '$articulo' LIMIT 1;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	$objRow = mysql_fetch_object( $query, "articulo" );
	$nomart = $objRow->Nombre;
	if ( $query ) mysql_free_result( $query );
	if ( $estado == 0 ) echo "<h4>Editar Unidades Pedidas $nomart</h4>";
	else echo "<h4>Editar Unidades Recibidas $nomart</h4>";
	
	include_once( "./form.inc.php" );
	echo "<p><input id=\"btnOk\" type=\"button\" value=\"Confirmar\" onclick=\"Dep.Art.updArtDep( $deposito, $articulo, $estado )\" />
	<input id=\"btnCancel\" type=\"button\" value=\"Cancelar\" onclick=\"listarArticulosDeposito( $deposito, $estado )\" /></p>";
	
	
	mysql_close( $db_resource );
?>
