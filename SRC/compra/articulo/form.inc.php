<?php
	$edit = ( !$pedidas ? "" : "display:none" );
	echo "<p><div style=\"$edit; width: 120px; float: left;\">Articulo: </div>
	<select id='slcArticulo' style='$edit; width: 150px;' 
	onblur='Com.Art.objValidaciones.valArticulo(this.selectedIndex)'>
	<option value='0' selected='selected' disabled='disabled'></option>";
	
	include_once( "../../articulo/select.inc.php" );
	
	echo "</select><input type=\"button\" value=\"...\" style=\"$edit;\"
	onclick=\"buscar('articulo', 'compra', $compra); document.getElementById('slcArticulo').focus()\" />
	<b><label id=\"valArticulo\"></label></b></p>
	<p><div style=\"width: 120px; float: left;\">Pedidas: </div>
	<input id=\"txtPedidas\" type=\"text\" value=\"" . ( $pedidas ? $pedidas : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, '0123456789');\" 
	onblur=\"Com.Art.objValidaciones.valPedidas(this.value)\" /><b><label id=\"valPedidas\"></label></b></p>";
?>
