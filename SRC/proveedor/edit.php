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
	$strQuery = "SELECT `CIF`, `Nombre`, `Direccion`, `Telefono`, `Mail`, `Comentario` FROM `proveedor` WHERE `ID` LIKE '$id' LIMIT 1;";
	if ( !$query = mysql_query( $strQuery, $db_resource ) ) sql_err("003");
	$objRow = mysql_fetch_object( $query, "proveedor" );
	$cif = $objRow->CIF;
	$nombre = $objRow->Nombre;
	$direccion = $objRow->Direccion;
	$telefono = $objRow->Telefono;
	$mail = $objRow->Mail;
	$comentario = $objRow->Comentario;

	echo "<h4>Editar Proveedor $nombre</h4>";
	include_once( "./form.inc.php" );
	echo "<p><input id=\"btnOk\" type=\"button\" value=\"Confirmar\" onclick=\"Pro.updPro($id)\" />
	<input id=\"btnCancel\" type=\"button\" value=\"Cancelar\" onclick=\"listar('proveedor')\" /></p> ";
	
	if ( $query ) mysql_free_result( $query );
	mysql_close( $db_resource );
?>
