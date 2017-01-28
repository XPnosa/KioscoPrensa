<?php
	echo "<p><div style=\"width: 120px; float: left;\">Nombre: </div>
	<input id=\"txtNombre\" type=\"text\" value=\"" . ( $nombre ? $nombre : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, strOk + ' _.-');\" 
	onblur=\"Fam.objValidaciones.valNombre(this.value)\" /><b><label id=\"valNombre\"></label></b></p>
	<p><div style=\"width: 120px; float: left;\">IVA: </div>
	<input id=\"txtIVA\" type=\"text\" value=\"" . ( $iva ? $iva : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, '1234567890.');\" 
	onblur=\"Fam.objValidaciones.valIVA(this.value)\" /><b><label id=\"valIVA\"></label></b></p>
	<p><div style=\"width: 120px; float: left;\">Recargo Eq: </div>
	<input id=\"txtRecEq\" type=\"text\" value=\"" . ( $receq ? $receq : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, '1234567890.');\" 
	onblur=\"Fam.objValidaciones.valRecEq(this.value)\" /><b><label id=\"valRecEq\"></label></b></p>
	<p><div style=\"width: 120px; float: left;\">Comentario: </div>
	<input id=\"txtComentario\" type=\"text\" value=\"" . ( $comentario ? $comentario : '' ) . "\" 
	onkeypress=\"return filtroTeclado(event, strOk + ' _.-');\" 
	onblur=\"Fam.objValidaciones.valComentario(this.value)\" /><b><label id=\"valComentario\"></label></b></p>";
?>
