<?php
if ( !isset( $_COOKIE ) ) {
	echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
	exit( 1 );
}
session_id( $_COOKIE[ "Kiosco" ] );
session_start();
?>

<h4>Nueva Familia</h4>
<?php include_once( "./form.inc.php" ); ?>
<p><input id="btnOk" type="button" disabled='disabed' value="Confirmar" onclick="Fam.regFam()" />
<input id="btnCancel" type="button" value="Cancelar" onclick="listar('familia')" /></p>
	
