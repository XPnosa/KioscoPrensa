<?php
	$edit = ( ( !$pedidas && $estado==0 ) ? "" : "display:none" );
	echo "<p><div style=\"$edit; width: 120px; float: left;\">Articulo: </div>
	<select id='slcArticulo' style='$edit; width: 150px;' 
	onblur='Dep.Art.objValidaciones.valArticulo(this.selectedIndex)'>
	<option value='0' selected='selected' disabled='disabled'></option>";
	
	include_once( "../../articulo/select.inc.php" );
	
	echo "</select><input type=\"button\" value=\"...\" style=\"$edit;\"
	onclick=\"buscar('articulo', 'deposito', $deposito); document.getElementById('slcArticulo').focus()\" />
	<b><label id=\"valArticulo\"></label></b></p>";
	
	if ( $estado == 0 ){
		echo "<p><div style=\"width: 120px; float: left;\">Pedidas: </div>
		<input id=\"txtPedidas\" type=\"text\" value=\"" . ( $pedidas ? $pedidas : '' ) . "\" 
		onkeypress=\"return filtroTeclado(event, '0123456789');\" 
		onblur=\"Dep.Art.objValidaciones.valPedidas(this.value)\" /><b><label id=\"valPedidas\"></label></b></p>";
	}else{
		echo "<p><div style=\"width: 120px; float: left;\">Recibidas: </div>
		<input id=\"txtRecibidas\" type=\"text\" value=\"" . ( $recibidas ? $recibidas : '0' ) . "\" 
		onkeypress=\"return filtroTeclado(event, '0123456789');\" 
		onblur=\"Dep.Art.objValidaciones.valRecibidas(this.value)\" /><b><label id=\"valRecibidas\"></label></b></p>";
	}
?>
