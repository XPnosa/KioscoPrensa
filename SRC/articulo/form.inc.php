<?php
	echo "<p><div style=\"width: 120px; float: left;\">Nombre: </div>
	<input id=\"txtNombre\" type=\"text\" value=\"" . ( $nombre ? $nombre : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, strOk + ' _.-');\" 
	onblur=\"Art.objValidaciones.valNombre(this.value)\" /><b><label id=\"valNombre\"></label></b></p>
	<p><div style=\"width: 120px; float: left;\">Familia: </div>
	<select id='slcFamilia' style='width: 150px;' 
	onblur='Art.objValidaciones.valFamilia(this.selectedIndex)'>
	<option value='0' selected='selected' disabled='disabled'></option>";
	
	include_once( "../familia/select.inc.php" );
	
	echo "</select><input type=\"button\" value=\"...\" 
	onclick=\"buscar('familia'); document.getElementById('slcFamilia').focus()\" /><b><label id=\"valFamilia\"></label></b></p>
	<p><div style=\"width: 120px; float: left;\">Proveedor: </div>
	<select id='slcProveedor' style='width: 150px;' 
	onblur='Art.objValidaciones.valProveedor(this.selectedIndex)'>
	<option value='0' selected='selected' disabled='disabled'></option>";
	
	include_once( "../proveedor/select.inc.php" );
	
	echo "</select><input type=\"button\" value=\"...\" 
	onclick=\"buscar('proveedor'); document.getElementById('slcProveedor').focus()\" /><b><label id=\"valProveedor\"></label></b></p>
	<p><div style=\"width: 120px; float: left;\">Precio Compra: </div>
	<input id=\"txtPCBase\" type=\"text\" value=\"" . ( $pcbase ? number_format($pcbase,4) : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, '1234567890.');\" 
	onblur=\"Art.objValidaciones.valPCBase(this.value)\" /><b><label id=\"valPCBase\"></label></b></p>
	<p><div style=\"width: 120px; float: left;\">Precio Venta: </div>
	<input id=\"txtPVP\" type=\"text\" value=\"" . ( $pvp ? number_format($pvp,4) : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, '1234567890.');\" 
	onblur=\"Art.objValidaciones.valPVP(this.value)\" /><b><label id=\"valPVP\"></label></b></p>
	<p><div style=\"width: 120px; float: left;\">Comentario: </div>
	<input id=\"txtComentario\" type=\"text\" value=\"" . ( $comentario ? $comentario : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, strOk + ' _.-');\" 
	onblur=\"Art.objValidaciones.valComentario(this.value)\" /><b><label id=\"valComentario\"></label></b></p>";
?>
