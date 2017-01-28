<?php
	if ( !isset( $_COOKIE ) ) {
		echo "<h1>Debe activar las cookies para usar esta aplicacion</h1>";
		exit( 1 );
	}
	session_id( $_COOKIE[ "Kiosco" ] );
	session_start();

	if ( !isset( $_POST[ 'Agrupar' ] ) ) {
		echo "<h1>Invocación incorrecta del script.</h1>";
		exit;
	}
	
	$group = $_POST[ 'Agrupar' ];

	echo "<center>Agrupar por:</center><center><input type=\"button\" value=\"Articulo\" onclick=\"mostrarEstadisticas('articulo');\" /><input type=\"button\" value=\"Proveedor\" onclick=\"mostrarEstadisticas('proveedor');\" /></center>";
	if ( $group == 'articulo' ) {
		echo "<br /><center><input type=\"text\" value=\"\" onkeypress=\"return filtroTeclado(event, strOk + ' _.-');\" id=\"schArt\" /></center>
		<center><input type=\"button\" value=\"Filtrar por articulo\" onclick=\"mostrarEstadisticas('articulo', null, document.getElementById('schArt').value);\" /></center>";
	}
	echo "<br /><center><input type=\"text\" value=\"\" onkeypress=\"return filtroTeclado(event, strOk + ' _.-');\" id=\"schPro\" /></center>
	<center><input type=\"button\" value=\"Filtrar por proveedor\" onclick=\"mostrarEstadisticas('$group', document.getElementById('schPro').value);\" /></center>";
?>
