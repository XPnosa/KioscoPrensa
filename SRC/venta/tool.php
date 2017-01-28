<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
		exit( 1 );
	}
	
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();
	
	if ( !isset( $_POST[ "ID" ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$id = $_POST[ "ID" ];
	
	echo "<label>ID: &nbsp;</label>";
	echo "<input style='width:30px' type='text' id='id' onkeypress='return filtroTeclado(event, \"0123456789\")' onkeyup= 'Art.getName(this.value);' onblur='validaUnidades(document.getElementById(\"btnAdd\"));' />";
	echo "<label id='nombre'></label><br />";
	echo "<label>Ud: </label>";
	echo "<input style='width:30px' type='text' id='txtPedidas' onkeypress='return filtroTeclado(event, \"0123456789\")' value=\"1\" onblur='validaUnidades(document.getElementById(\"btnAdd\"));'/>";
	echo "<label id='valPedidas'></label>";
	echo "<input id=\"btnAdd\" type=\"button\" disabled='disabled' value=\"Añadir\" onclick=\"Ven.newArtVen($id, document.getElementById('id').value,document.getElementById('txtPedidas').value)\" />";
	echo "<input id=\"btnCancel\" type=\"button\" style=\"float:right;\" value=\"Cancelar\" onclick=\"Ven.delVen($id)\" />";
	echo "<input id=\"btnConfirm\" type=\"button\" style=\"float:right;\" value=\"Confirmar\" onclick=\"cierraVenta(document.getElementById('import').value,document.getElementById('txtPay').value);\" />";
	echo "<input id=\"txtPay\" type=\"text\" onkeypress='return filtroTeclado(event, \"0123456789.\")' style=\"float:right; width:60px\" />";
	echo "<label style=\"float:right\">Importe Pagado: </label>";
?>
