<?php
	$edit = ( !$cliente ? "" : "display:none" );

	echo "<p><div style=\"$edit; width: 120px; float: left;\">Cliente: </div>
	<select id='slcCliente' style='$edit; width: 150px;' 
	onblur='Com.objValidaciones.valCliente(this.selectedIndex)'>
	<option value='0' selected='selected' disabled='disabled'></option>";
	
	include_once( "../cliente/select.inc.php" );
	
	echo "</select><input type=\"button\" value=\"...\" style=\"$edit;\"
	onclick=\"buscar('cliente'); document.getElementById('slcCliente').focus()\" /><b><label id=\"valCliente\"></label></b></p>
	<p><div style=\"width: 120px; float: left;\">Comentario: </div>
	<input id=\"txtComentario\" type=\"text\" value=\"" . ( $comentario ? $comentario : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, strOk + ' _.-');\" 
	onblur=\"Com.objValidaciones.valComentario(this.value)\" /><b><label id=\"valComentario\"></label></b></p>";
?>
