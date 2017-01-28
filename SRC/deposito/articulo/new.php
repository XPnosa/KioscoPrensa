<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
		exit( 1 );
	}
	if ( !isset( $_POST[ "ID_Dep" ] )  ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$deposito = $_POST[ "ID_Dep" ];
?>
<h4>Nuevo Articulo</h4>
<?php include_once( "./form.inc.php" ); ?>
<p><input id="btnOk" type="button" disabled='disabed' value="Confirmar" onclick="Dep.Art.regArtDep( <?php echo $deposito; ?> )" />
<input id="btnCancel" type="button" value="Cancelar" onclick="listarArticulosDeposito( <?php echo $deposito; ?>, 0 )" /></p>
