<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
		exit( 1 );
	}
	if ( !isset( $_POST[ "ID_Com" ] )  ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$compra = $_POST[ "ID_Com" ];
?>
<h4>Nuevo Articulo</h4>
<?php include_once( "./form.inc.php" ); ?>
<p><input id="btnOk" type="button" disabled='disabed' value="Confirmar" onclick="Com.Art.regArtCom( <?php echo $compra; ?> )" />
<input id="btnCancel" type="button" value="Cancelar" onclick="listarArticulosCompra( <?php echo $compra; ?> )" /></p>
