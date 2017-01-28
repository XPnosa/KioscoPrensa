<?php
if ( !isset( $_COOKIE ) ) {
	echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
	exit( 1 );
}
session_id( $_COOKIE[ "Kiosco" ] );
session_start();
?>
<?php
	if ( !isset( $_POST[ 'ID_Com' ] ) || !isset( $_POST[ 'ID_Art' ] ) || !isset( $_POST[ 'Unidades' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	include_once( "../../db_info.inc.php" );
	include_once( "../../db_class.inc.php" );
	
	$compra = $_POST[ 'ID_Com' ];
	$articulo = $_POST[ 'ID_Art' ];
	$pedidas = $_POST[ 'Unidades' ];
	
	$strQuery = "SELECT `Nombre` FROM `articulo` WHERE `ID` = '$articulo' LIMIT 1;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	$objRow = mysql_fetch_object( $query, "articulo" );
	$nomart = $objRow->Nombre;
	if ( $query ) mysql_free_result( $query );
	echo "<h4>Editar Unidades $nomart</h4>";
	include_once( "./form.inc.php" );
	echo "<p><input id=\"btnOk\" type=\"button\" value=\"Confirmar\" onclick=\"Com.Art.updArtCom( $compra, $articulo, $pedidas, document.getElementById('txtPedidas').value )\" />
	<input id=\"btnCancel\" type=\"button\" value=\"Cancelar\" onclick=\"listarArticulosCompra( $compra )\" /></p>";
	
	mysql_close( $db_resource );
?>
