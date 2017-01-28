<?php
if ( !isset( $_COOKIE ) ) {
	echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
	exit( 1 );
}
?>
<h4>Nuevo Articulo</h4>
<?php include_once( "./form.inc.php" ); ?>
<p><input id="btnOk" type="button" disabled='disabed' value="Confirmar" onclick="Art.regArt()" />
<input id="btnCancel" type="button" value="Cancelar" onclick="listar('articulo')" /></p>
<?php mysql_close( $db_resource ); ?>
