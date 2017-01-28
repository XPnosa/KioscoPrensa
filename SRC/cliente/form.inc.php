<?php
	echo "<p><div style=\"width: 120px; float: left;\">DNI: </div>
	<input id=\"txtDNI\" type=\"text\" value=\"" . ( $dni ? $dni : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');\" 
	onblur=\"Cli.objValidaciones.valDNI(this.value)\" /><b><label id=\"valDNI\"></label></b></p>
	<p><div style=\"width: 120px; float: left;\">Nombre: </div>
	<input id=\"txtNombre\" type=\"text\" value=\"" . ( $nombre ? $nombre : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, strOk + ' _.-');\" 
	onblur=\"Cli.objValidaciones.valNombre(this.value)\" /><b><label id=\"valNombre\"></label></b></p>
	<p><div style=\"width: 120px; float: left;\">Direccion: </div>
	<input id=\"txtDireccion\" type=\"text\" value=\"" . ( $direccion ? $direccion : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, strOk + ' _,-.:/ºª');\" 
	onblur=\"Cli.objValidaciones.valDireccion(this.value)\" /><b><label id=\"valDireccion\"></label></b></p>
	<p><div style=\"width: 120px; float: left;\">Telefono: </div>
	<input id=\"txtTelefono\" type=\"text\" value=\"" . ( $telefono ? $telefono : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, '1234567890');\" 
	onblur=\"Cli.objValidaciones.valTelefono(this.value)\" /><b><label id=\"valTelefono\"></label></b></p>
	<p><div style=\"width: 120px; float: left;\">Mail: </div>
	<input id=\"txtMail\" type=\"text\" value=\"" . ( $mail ? $mail : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, '1234567890@abcdefghijklmnopqrstuvwxyz_.-');\" 
	onblur=\"Cli.objValidaciones.valMail(this.value)\" /><b><label id=\"valMail\"></label></b></p>
	<p><div style=\"width: 120px; float: left;\">Comentario: </div>
	<input id=\"txtComentario\" type=\"text\" value=\"" . ( $comentario ? $comentario : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, strOk + ' _.-');\" 
	onblur=\"Cli.objValidaciones.valComentario(this.value)\" /><b><label id=\"valComentario\"></label></b></p>";
?>
