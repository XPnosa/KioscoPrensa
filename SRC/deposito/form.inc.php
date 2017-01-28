<?php
	$edit = ( !$proveedor ? "" : "display:none" );

	echo "<p><div style=\"$edit; width: 120px; float: left;\">Proveedor: </div>
	<select id='slcProveedor' style='$edit; width: 150px;' 
	onblur='Dep.objValidaciones.valProveedor(this.selectedIndex)'>
	<option value='0' selected='selected' disabled='disabled'></option>";
	
	include_once( "../proveedor/select.inc.php" );
	
	echo "</select><input type=\"button\" value=\"...\" style=\"$edit;\"
	onclick=\"buscar('proveedor'); document.getElementById('slcProveedor').focus()\" /><b><label id=\"valProveedor\"></label></b></p>
	<p><div style=\"width: 120px; float: left;\">Comentario: </div>
	<input id=\"txtComentario\" type=\"text\" value=\"" . ( $comentario ? $comentario : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, strOk + ' _.-');\" 
	onblur=\"Dep.objValidaciones.valComentario(this.value)\" /><b><label id=\"valComentario\"></label></b></p>";
?>
