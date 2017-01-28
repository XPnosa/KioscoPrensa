<?php
if ( !isset( $_COOKIE ) ) {
	echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
	exit( 1 );
}
session_id( $_COOKIE[ "Kiosco" ] );
session_start();
?>
<?php
	if ( !isset( $_POST[ 'ID' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	include_once( "../db_info.inc.php" );
	include_once( "../db_class.inc.php" );
	
	$id = $_POST[ 'ID' ];
	$strQuery = "SELECT `ID_Cli`, `Comentario` FROM `compra` WHERE `ID` LIKE '$id' LIMIT 1;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	$objRow = mysql_fetch_object( $query, "compra" );
	$cliente = $objRow->ID_Cli;
	$comentario = $objRow->Comentario;
	if ( $query ) mysql_free_result( $query );

	echo "<h4>Editar Compra #$id</h4>";
	include_once( "./form.inc.php" );
	echo "<p><input id=\"btnOk\" type=\"button\" value=\"Confirmar\" onclick=\"Com.updCom($id)\" />
	<input id=\"btnCancel\" type=\"button\" value=\"Cancelar\" onclick=\"listar('compra')\" /></p>";
	
	mysql_close( $db_resource );
?>
